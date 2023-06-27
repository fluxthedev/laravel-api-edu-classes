<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resource;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CSVExportController extends Controller
{
  public function exportResources()
  {
    $headers = [
      "Content-type" => "text/csv",
      "Content-Disposition" => "attachment; filename=resources.csv",
      "Pragma" => "no-cache",
      "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
      "Expires" => "0"
    ];

    $callback = function () {
      $handle = fopen('php://output', 'w');
      // Write the column headers
      fputcsv($handle, ['title', 'cost', 'short_description', 'grade_span']);

      // Write the resource data
      $resources = Resource::all();
      foreach ($resources as $resource) {
        fputcsv($handle, [$resource->title, $resource->cost, $resource->short_description, $resource->grade_span]);
      }
      fclose($handle);
    };

    return new StreamedResponse($callback, 200, $headers);
  }
}
