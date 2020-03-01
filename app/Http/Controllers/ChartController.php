<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class ChartController extends Controller
{
    function index()
    {
      $data['year_list'] = $this->fetch_year();

      dd($data['year_list'])->toArray();
    //  $this->load->view('dynamic_chart', $data);

    return view('charts')->with($data);
    }
   
    function fetch_data()
    {
     if($this->input->post('year'))
     {
      $chart_data = $this->fetch_chart_data($this->input->post('year'));
      
      foreach($chart_data->result_array() as $row)
      {
       $output[] = array(
        'month'  => $row["month"],
        'profit' => floatval($row["profit"])
       );
      }
      echo json_encode($output);
     }
    }

    function fetch_year()
    {
    //  $this->db->select('year');
    //  $this->db->from('chart_data');
    //  $this->db->group_by('year');
    //  $this->db->order_by('year', 'DESC');
    //  return $this->db->get();
    $data = DB::table('chart_data')->select(DB::raw('year'))->groupBy('year')->orderBy('year', 'DESC')->get();
    return $data;
    }
   
    function fetch_chart_data($year)
    {
    //  $this->db->where('year', $year);
    //  $this->db->order_by('year', 'ASC');
    //  return $this->db->get('chart_data');
  
    }
}
