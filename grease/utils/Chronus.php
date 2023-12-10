<?php

class Chronus {
  
  static public function formater($inicial_date) 
  {
    return date('d/m/Y', strtotime($inicial_date));
  }
}