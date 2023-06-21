<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
  /**
   * Display a listing of the resources.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $tags = $request->get('tags');

    if ($tags) {
      $tagArray = explode(',', $tags);

      $resources = Resource::where(function ($query) use ($tagArray) {
        foreach ($tagArray as $tag) {
          $query->orWhere('tags', 'like', '%' . trim($tag) . '%');
        }
      })->paginate(15);  // 15 is the number of items per page
    } else {
      $resources = Resource::paginate(15);  // 15 is the number of items per page
    }

    return response()->json($resources);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $resource = Resource::create($request->all());

    return response()->json($resource, 201);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    return response()->json(Resource::find($id));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $resource = Resource::find($id);
    $resource->update($request->all());

    return response()->json($resource);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $resource = Resource::find($id);
    $resource->delete();

    return response()->json(null, 204);
  }
}
