<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\Location;
use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class IncidentController extends Controller
{
    protected $incident;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Incident $incident)
    {
        $this->incident = $incident;
    }

    /**
     * featch incident
     */
    public function index(){

        $incidents = $this->incident->with('location:incident_id,longitude,latitude','people:incident_id,name,type')
        ->get();

        if(!empty($incidents->toArray())){
            return response(['data' => $incidents], 200);
        }

        return response(['errors' => 'Incident not fond.'], 422);
    }

    public function save(Request $request){
        // validation
        $validator = Validator::make($request->all(), [
            'category' => ['required', 'integer', 'exists:category,id'],
            'incidentDate' => ['required' , 'date'],
            'location.latitude' => ['required'],
            'location.longitude' => ['required']
        ]);

        if ($validator->fails()) {
            return response(['created' => false, 'errors' => $validator->errors()->all()], 422);
        }

        $query = DB::transaction(function () use ($request){
            //save incident
            $incident = new Incident();
            $incident->title = $request->title;
            $incident->category_id = $request->category;
            $incident->incident_date = date('Y-m-d h:i:s', strtotime($request->incidentDate));
            $incident->comments = $request->comments;
            $incident->created_at = (!empty($request->createDate)) ?  date('Y-m-d h:i:s', strtotime($request->createDate)) : date('Y-m-d H:i:s');
            $incident->updated_at = (!empty($request->modifyDate)) ?  date('Y-m-d  H:i:s', strtotime($request->modifyDate)) : date('Y-m-d H:i:s');
            $incident->save();

            //save incident people
            foreach($request->people as $people){
                $incident_people = new People();
                $incident_people->incident_id = $incident->id;
                $incident_people->name = $people['name'];
                $incident_people->type = $people['type'];
                $incident_people->save();
            }

            //save incident location
            $location = new Location();
            $location->incident_id = $incident->id;
            $location->latitude = $request->location['latitude'];
            $location->longitude = $request->location['longitude'];
            $location->save();

            return compact('incident');
        });
        $incident = $query['incident'];

        $incidents = $this->incident->with('people:incident_id,name,type', 'location:incident_id,longitude,latitude')
        ->find($incident->id);

        if($incidents){
            return response(['created' =>true ,'data' => $incidents], 200);
        }

        return response(['errors' => 'somthing went wrong, please try again'], 422);
    }

}
