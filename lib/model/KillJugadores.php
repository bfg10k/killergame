<?php


/**
 * Skeleton subclass for representing a row from the 'kill_jugadores' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Thu Oct 25 16:48:16 2012
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class KillJugadores extends BaseKillJugadores {

	/**
	 * Initializes internal state of KillJugadores object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}

        public function getRango()
        {
          $rango = "Associato";
          
          $numMuertes = $this->countKillMuertessRelatedByIdAsesino();
          
          switch($numMuertes)
          {
            case 0:
              $rango = "Associato";
              break;
            case 1:
              $rango = "Soldato";
              break;
            case 2:
              $rango = "Capodecime";
              break;
            case 3:
              $rango = "Caporegime";
              break;
            case 4:
              $rango = "Consigliere";
              break;
            case 5:
              $rango = "Sottocapo";
              break;
            case 6:
              $rango = "Don";
              break;
            default:
              $rango = "Associato";
              break;
          }
          return $rango;
    
        }

} // KillJugadores
