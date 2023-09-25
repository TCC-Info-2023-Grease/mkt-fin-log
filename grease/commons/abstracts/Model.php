<?

# Model
#
#

class Model {
  protected $mysqli;


  public function __construct($mysqli) 
  {
    $this->mysqli = $mysqli;
  }



}

