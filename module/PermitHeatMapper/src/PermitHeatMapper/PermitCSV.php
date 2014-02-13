<?php
namespace PermitHeatMapper;
/**
 * Description of PermitCSVFile
 *
 * @author Jim Smiley twitter:@jimRsmiley
 */
class PermitCSV {
    
    protected $dataDir;
    protected $filePattern;
    protected $outFile;
    
    public function __construct( $permitJsonDir, $pattern, $outFile ) {
        $this->dataDir = $permitJsonDir;
        $this->filePattern = $pattern;
        $this->outFile = $outFile;
    }
    


    public function extractPermits() {
        $files = $this->getFiles($this->dataDir,$this->filePattern);
        
        if(file_exists($this->outFile) )
            unlink( $this->outFile );
        
        #$df = fopen("php://output", 'w');
        $df = fopen($this->outFile, 'w');

        $headerOut = false;
        
        $counter = new \JSMappingUtils\Counter();
        foreach( $files as $file ) {
            print "processing file " . $file . "\n";
            $jsonObject = \Zend\Json\Json::decode( file_get_contents($file), \Zend\Json\Json::TYPE_ARRAY );
            foreach( $jsonObject['d']['results'] as &$permitArray ) {
                
                $permit = new \PermitHeatMapper\Entity\Permit( $permitArray );
                $hydrator = new \Zend\Stdlib\Hydrator\ClassMethods();
                $array = $hydrator->extract( $permit );
                unset( $array['point'] );
                unset( $array['id'] );
                unset( $array['seperator'] );
                unset( $array['full_address'] );
                $array['updated_datetime'] = date( "Y-m-d H:m:s", $array['updated_datetime']->getTimestamp() );
                $array['issued_datetime'] = date( "Y-m-d H:m:s", $array['issued_datetime']->getTimestamp() );
            
                if( !$headerOut ) {
                    fputcsv($df,array_keys( $array ) );
                    $headerOut = true;
                }                
                fputcsv($df, array_values( $array ) );
            }
        }
    }
    
    public function getFiles() {
        $files = array();
        // Open a known directory, and proceed to read its contents
        if (is_dir($this->dataDir)) {
            if ($dh = opendir($this->dataDir)) {
                while (($file = readdir($dh)) !== false) {

                    if( preg_match( '/'.$this->filePattern.'/',$file ) ) {
                       array_push( $files, $this->dataDir.'/'.$file );
                    }
                }
                closedir($dh);
            }
        }
        return $files;
    }
}

?>
