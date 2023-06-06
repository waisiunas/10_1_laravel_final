<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class DynamicController extends Controller
{
    public function fetch_topics()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $topics = Topic::where('subject_id', $data['subject_id'])->get();
        if(count($topics) > 0) {
            $output = '<option value="" selected hidden>Select a topic!</option>';
            foreach($topics as $topic) {
                $output .= '<option value="' . $topic->id .'">' . $topic->name . '</option>';
            }
        } else {
            $output = '<option value="" selected hidden>No Topic Found!</option>';
        }

        echo json_encode($output);
    }
}
