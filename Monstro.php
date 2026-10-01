<?php
	
	enum Condicao {
		case Normal;
		case Envenenamento;
		case Queimadura;
		case Congelamento;
		case Sono;
		case Paralisia;
	}
	
	trait MonstroTipo {
		
	}
	
	class Monstro {
		use MonstroTipo;
    
		private string			  $nome;
		private readonly bool	$esta_vivo;
		private Condicao		  $condicao;
		private ?int			    $vida		    = null;
		private ?int			    $velocidade	= null;
		private ?int		    	$defesa		  = null;
		private ?int		    	$ataque		  = null;
		private ?int		  	  $nivel		  = null;
		private ?int		    	$pontos_mov	= null;
		private ?int		  	  $exp		    = null;
		private ?string		   	$golpes		  = null;
	}

?>
