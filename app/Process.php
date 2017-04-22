<?php 
namespace App;
use Illuminate\Http\Request;

class Process
{
    protected $_xml;
    protected $path = "businesslayer.xml";

    public function __construct()
    {
        $this->_xml = simplexml_load_file("businesslayer.xml");
    }

    public function getXml()
    {
        return $this->_xml;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    public function Ruleslist()
    {
        $Rules =  $this->_xml->Inference->Cluster->Rule;

        $rulesToReturn = [];
        $RulesTest = [];

        foreach ($Rules as $Rule) {

            $rulesToReturn['Name'] = $Rule->attributes()->Name;
            $rulesToReturn['game'] = $Rule->attributes()->game;
            for ($i=0; $i <4 ; $i++) { 
                $prop =  $Rule->Tuple[$i]->attributes()->Prop;
                $val =  $Rule->Tuple[$i]->attributes()->Val;

                $rulesToReturn[trim($prop)] = $val;
            }
            array_push($RulesTest, $rulesToReturn);

        }
        return $RulesTest;
    }

    public function filterList($data){
        $recommentations = [];
        $Rules = $this->_xml->Inference->Cluster->Rule;
        foreach ($Rules as $Rule) {

            if ($data['fitness'] == $Rule->Tuple[0]->attributes()->Val &&
                $data['speed'] == $Rule->Tuple[1]->attributes()->Val &&
                $data['tallness'] == $Rule->Tuple[2]->attributes()->Val && 
                $data['weight'] == $Rule->Tuple[3]->attributes()->Val ) 
            {
                # code...
                array_push($recommentations, $Rule->attributes()->game);
            }
        }
        return $recommentations ;
    }

    public function AddRule($data,$nameGame)
    {
        $Rules = $this->_xml->Inference->Cluster;

        $Rule = $Rules->addChild('Rule','');

        foreach ($data as $key => $value) {
            # code...
           $Tuple = $Rule->addChild('Tuple', '');
           $Tuple->addAttribute('Cpt', 'member');
           $Tuple->addAttribute('Prop', $key);
           $Tuple->addAttribute('Val', $value);
       }
       $Rule->addAttribute('Name',$nameGame['name']);
       $Rule->addAttribute('game',$nameGame['game']);
       $this->_xml->asXML($this->path);
   }

   public function DeleteRule($name)
   {
    list($Rule) = $this->_xml->xpath('////Rule[@Name="' . $name . '"]');
    $oNode = dom_import_simplexml($Rule);
    $oNode->parentNode->removeChild($oNode);
    $this->_xml->asXML($this->path);
    
}
public function getRuleByName($name)
{
    list($Rule) = $this->_xml->xpath('////Rule[@Name="' . $name . '"]');
    $ruleToReturn['Name'] = $Rule[0]->attributes()->Name;
    $ruleToReturn['game'] = $Rule[0]->attributes()->game;
    
    for ($i=0; $i <4 ; $i++) { 
            # code...
        $prop =  $Rule[0]->Tuple[$i]->attributes()->Prop;
        $val =  $Rule[0]->Tuple[$i]->attributes()->Val;
        $ruleToReturn[trim($prop)]=$val;

    }
    return $ruleToReturn;
}

public function updateRule($data,$name)
{
    list($Rule) = $this->_xml->xpath('////Rule[@Name="' . $name . '"]');
    
    $Rule[0]->attributes()->Name = $data["name"];
    $Rule[0]->attributes()->game = $data["game"];

    $Rule[0]->Tuple[0]->attributes()->Val = $data['fitness'];
    $Rule[0]->Tuple[1]->attributes()->Val = $data['speed'];
    $Rule[0]->Tuple[2]->attributes()->Val = $data['tallness'];
    $Rule[0]->Tuple[3]->attributes()->Val = $data['weight'];

    $this->_xml->asXML($this->path);
}
}