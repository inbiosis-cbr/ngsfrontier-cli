<?php
class PackageCommand extends CConsoleCommand
{
    // Define attributes and methods!

    public function getHelp()
    {

        return <<<EOT
USAGE
  ngsfrontier-cli package action param1=xxx param2=xxx

DESCRIPTION
  This command packages software in NGSFrontier base box 
  following defined protocol in documentation.

PARAMETERS
 * action: required, available options: list, inspect, validate
        default: list

 * list
    List packages under your package path. Default to look 
    at /usr/local

 example:
    ngsfrontier-cli package list

 * inspect <name>
    Show installed package's information and check for updates.
    
    <name> Package directory/folder name.

 example:
    ngsfrontier-cli package inspect --name=bowtie

 * validate <name>
    Validate a package render it's status.

    <name> Package directory/folder name.
 example:
    ngsfrontier-cli package validate --name=bowtie 

- END -

EOT;

    }

	public function actionList()
	{

        $packages = array();
        $packagePath = "/usr/local";
        if ($handle = opendir($packagePath)) {
            /* This is the correct way to loop over the directory. */
            while (false !== ($entry = readdir($handle))) {
                if(is_dir($packagePath . DIRECTORY_SEPARATOR . $entry) && $entry != "." && $entry != ".."){
                    //Look for meta.json
                    $checkPackageMetaJSONPath = $packagePath . DIRECTORY_SEPARATOR . $entry . DIRECTORY_SEPARATOR . "/meta.json";
                    if(file_exists($checkPackageMetaJSONPath)){
                        $metadata = json_decode(file_get_contents($checkPackageMetaJSONPath), true);
                        if(isset($metadata['name'])){
                            array_push($packages, $metadata);
                        }
                    }
                }
            }

            closedir($handle);
        }

        $packageListStr = "";
        foreach($packages AS $p){
            $installDatetime = date('Y-m-d H:i:s', strtotime($p['createdAt']));
            $packageListStr .= <<<EOT
{$p['name']} ({$p['version']}) - Installed since {$installDatetime}

EOT;
        }

        echo <<<EOT
List of installed packages:
{$packageListStr}
EOT;

		echo "\n";
    	return 0;		
	}

    public function actionInspect($name)
    {

        echo <<<EOT
Inspecitng package:

EOT;

        echo "\n";
        return 0;       
    }

    public function actionValidate($name)
    {

        if(isset($name)){
            $validateStatus = 'NOT VALIDATED';
            $validateFixStatus = "NO FIXED";
            $fixValidateText = "";
            $packagePath = "/usr/local" . DIRECTORY_SEPARATOR . $name;
            $metaPath = $packagePath . DIRECTORY_SEPARATOR . "meta.json";
            if(file_exists($metaPath)){
                //Check if validate.ok
                $metadata = json_decode(file_get_contents($metaPath), true);
                $validateOk = $packagePath . DIRECTORY_SEPARATOR . "validate.ok";
                if(file_exists($validateOk)){
                    $validateStatus = "OK";
                } else {
                    //Try to fix
                    if(isset($metadata['validate-cmd'])){
                        $validateTestPath = $packagePath . DIRECTORY_SEPARATOR . "validate.test";
                        $validateSamplePath = $packagePath . DIRECTORY_SEPARATOR . "package.validate";
                        $cmd = $packagePath . DIRECTORY_SEPARATOR . $metadata['validate-cmd'] . " > " . $validateTestPath;
                        $run = exec($cmd);
                        if(isset($validateTestPath) && $validateSamplePath){
                            $validateTest = file_get_contents($validateTestPath);
                            $validateSample = file_get_contents($validateSamplePath);
                            $validateErr = $packagePath . DIRECTORY_SEPARATOR . "validate.err";
                            if(file_exists($validateErr)){
                                unlink($validateErr);
                            }

                            if($validateTest == $validateSample){
                                file_put_contents($validateOk, 'OK');
                                $validateFixStatus = 'FIXED';
                            } else {
                                file_put_contents($validateErr, 'ERROR');
                                $validateFixStatus = 'ERROR';
                            }

                            $fixValidateText = <<<EOT
Fix validation:
{$metadata['name']} {$metadata['version']} [{$validateFixStatus}]
EOT;
                        }
                    }
                }
            } else {
                echo <<<EOT
[ERROR] Package is not found.

EOT;
                return 1;
            }

            echo <<<EOT
Validating package:
{$metadata['name']} {$metadata['version']} [{$validateStatus}]
{$fixValidateText}
EOT;

        } else {
            echo <<<EOT
[ERROR] Name is required.

EOT;
            return 1;
        }

        echo "\n";
        return 0;       
    }

    public function actionIndex()
    {
    	echo <<<EOT
                                                                           
,--.  ,--.,----.   ,---. ,------.                    ,--. ,--.             
|  ,'.|  '  .-./  '   .-'|  .---,--.--.,---.,--,--,,-'  '-`--',---.,--.--. 
|  |' '  |  | .---`.  `-.|  `--,|  .--| .-. |      '-.  .-,--| .-. |  .--' 
|  | `   '  '--'  .-'    |  |`  |  |  ' '-' |  ||  | |  | |  \   --|  |    
`--'  `--'`------'`-----'`--'   `--'   `---'`--''--' `--' `--'`----`--'    
                                                                           

Developed by Loke Kok Keong <kkloke86@zetilab.org>

EOT;

    	echo $this->getHelp();
		echo "\n";
    	return 0;
    }
}
