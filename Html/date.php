<?php

class Date{
	 var $year = array ('2015', '2016' , '2017');
     var $days = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi','Dimanche');
     var $months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
     
function getAll($year){

	$r = array();
	/*
	premiere methode pour avoir les tableaux de j/m/annee
	/*
	$date = strtotime($year.'-01-01');
	while(date('y',$date) <= $year){

		$y= date('y',$date);
		$m= date('n',$date);
		$d= date('j',$date);
		$w= str_replace('0','7',date('w',$date));

		$r[$y][$m][$d] = $w;
		$date = strtotime(date('y-m-d',$date).' +1 DAY');
		}
		*/
     /*deuxieme methode en utilisant  OO */

     $date = new Datetime($year.'01-01');
     while($date->format('Y') <= $year){

		$y= $date->format('Y');
		$m= $date->format('n');
		$d= $date->format('j');
		$w= str_replace('0','7',$date ->format('w'));

		$r[$y][$m][$d] = $w;
		$date->add(new DateInterval('P1D'));
		}
	return $r;
 	}
}

?>