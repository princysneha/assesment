<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model {

    public function country(){
        $this->db->select('*');
        $this->db->from('country');
        return $query = $this->db->get()->result();
    }

    public function state($country_id){
        $this->db->select('*');
        $this->db->from('state');
        $this->db->where('country_id',$country_id);
        return $query = $this->db->get()->result();
    }

    public function city($state_id){
        $this->db->select('*');
        $this->db->from('city');
        $this->db->where('state_id',$state_id);
        return $query = $this->db->get()->result();    
    }

    public function getAll(){
        $this->db->select('c.name AS county_name,s.name AS state_name,c.name AS city_name,c.id');
        $this->db->from('country AS c');
        $this->db->join('state AS s','s.country_id=c.id','left');
        $this->db->join('city AS ci','ci.state_id=s.id','left');
     
        return $query = $this->db->get()->result();    
    }

}