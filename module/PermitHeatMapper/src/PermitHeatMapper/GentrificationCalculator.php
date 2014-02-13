<?php
namespace PermitHeatMapper;
/**
 * GentrificationCalculator handles the math for figuring out how much a
 * point is gentrifying
 *
 * @author Jim Smiley twitter:@jimRsmiley
 */
class GentrificationCalculator {
    
    /**
     * take the percent change in permits over time and multiply that by the number
     * of permits. That will give advantage to locations which have a large amount of permits
     * and a significant amount of increase over time.
     * 
     * @param array $permitsGroup1
     * @param array $permitsGroup2
     * @return int weight
     */
    public static function calc( $permitsGroup1, $permitsGroup2 ) {
        
        $date1_range_count = count( $permitsGroup1 );
        $date2_range_count = count( $permitsGroup2 );

        $decimalChange = 0;

        if( $date1_range_count !== 0 || $date2_range_count !== 0 )
            $decimalChange = ( $date2_range_count - $date1_range_count ) / ($date1_range_count + $date2_range_count );
        
        $weight = $decimalChange * ( $date1_range_count + $date2_range_count );
        
        if( $weight < 0 ) 
            return 0;
        
        return $weight;
    }
}

?>
 