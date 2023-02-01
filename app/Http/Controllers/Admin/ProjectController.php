<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Technology;
use App\Models\Types;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Types::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        
        $data = $request->validated();
        $new_project = new Project();
        $new_project->fill($data);
        $new_project->slug = Str::slug($new_project->title, '-');
        if(isset($data['cover_image'])){
            $new_project->cover_image = Storage::disk('public')->put('uploads', $data['cover_image']);
        }
        $new_project->save(); 
        if(isset($data['technologies'])){
            $new_project->technologies()->sync($data['technologies']);
        }
        return redirect()->route('admin.projects.index')->with('message', "Il progetto $new_project->title è stato creato");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)

    {
        $technologies = Technology::all();
        $types = Types::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        
        $old_title = $project->title;
        $data = $request->validated();
        $project->slug = Str::slug($data['title'], '-');
        if(isset($data['cover_image'])){
            if($project->cover_image){
                Storage::disk('public')->delete($project->cover_image);
            }
            $data['cover_image'] = Storage::disk('public')->put('uploads', $data['cover_image']);
        }
        $project->update($data); 
        if(isset($data['technologies'])){
            $project->technologies()->sync($data['technologies']);
        }else{
            $project->technologies()->sync([]);
        }
        return redirect()->route('admin.projects.index')->with('message', "Il progetto $old_title è stato modificato");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $old_title = $project->title;
        if( $project->cover_image ) {
            Storage::disk('public')->delete($project->cover_image);
        }
        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', "Il progetto $old_title è stato eliminato");
    }
}
