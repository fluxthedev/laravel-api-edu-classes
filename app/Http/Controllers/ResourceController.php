<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ResourceController extends Controller
{
  protected $resource;

  public function __construct(Resource $resource)
  {
    $this->resource = $resource;
  }

  public function index(Request $request)
  {
    $tags = $request->get('tags');

    $query = $this->resource->query();

    if ($tags) {
      $tagArray = array_map('trim', explode(',', $tags));
      $query->where(function ($query) use ($tagArray) {
        $query->orWhereIn('tags', $tagArray);
      });
    }

    $resources = $query->paginate(15);

    return response()->json($resources);
  }

  public function store(Request $request)
  {
    $resource = $this->resource->create($request->all());

    return response()->json($resource, Response::HTTP_CREATED);
  }

  public function show($id)
  {
    $resource = $this->resource->find($id);

    return response()->json($resource);
  }

  public function update(Request $request, $id)
  {
    $resource = $this->resource->find($id);
    $resource->update($request->all());

    return response()->json($resource);
  }

  public function destroy($id)
  {
    $resource = $this->resource->find($id);
    $resource->delete();

    return response()->json(null, Response::HTTP_NO_CONTENT);
  }
}
