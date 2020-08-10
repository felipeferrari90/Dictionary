<?php

//ACOPLAMENTO - é o nivel de dependencia de uma classe para outra

class A {}
class B extends A{}

/* voce criou um altissimo grau de acoplamento da classe B em relacao a A 
significa que se vc tiver que reaproveirar a classe B em algum outro projeto
a classe A vai ter que ir junto */

/*a classe A nao possui acoplamento com B*/

/* o ideal é as classes possuirem baixo ou nenhum acoplamento entre si */

class C {
    public function test(){
        $a = new A();
    }
}

/* toda vez que vc instancia um obj dentro de outro obj vc tbm esta criando um alto
grau de acoplamento (C possui alto acoplamento em relacao a A)

/* a criacao de um software 100% desacoplado é muito trabalhoso porem dependendo 
do contexto as vezes vc precisa acoplar o codigo, mas sempre desacople ela*/

class D {
    public function hello(){
        return "Hello"
    }
}

class E  {
    public function test(){
        $d = new D();
        $d->hello();
    }
}


/* E como resolver a questao do desacoplamento? 
É A TAL DA INJECAO DE DEPENDENCIA */

/*
    INJECAO DE DEPENDENCIA - é o ato de vc pegar as classes que dependem de outras classes
                            e injetalas no metodo construtor ou nos setters fazendo com oque o 
                            acoplamento diminua fazendo com que vc gerencia melhor suas classes 

                            vamos aplicar editando a classe D e E 
*/

class D {
    public function hello(){
        return "Hello"
    }
}

class E  {

    private $d;

    public __construct(D $d){
        $this->d = $d;
    }

    public function test(){
        $this->d->hello();
    }
}

/**
 * 
 *  DESACOPLOU muito porque vc tirou a instanciação DIRETAMENTE um obj dentro do outro 
 *  porem o acoplamento ainda é grande (E ainda ta dependendo de D)
 * 
 */ 

$d = new D;
$e = new E($d);

/*
   injeção de dependencia - eu to injetando a minha dependencia D dentro da classe E 
                            ao inves de vc sair instanciando o objeto por ai.

    apesar do acoplamento isso ainda ajuda muito porque imaginando que precisaremos de 
    D novamente, teriamos que criar varios objetos dentro da nossa classe e instanciando
    varios objetos dentro de uma classe nao é legal por isso fizemos isso                      

 */

 /* regra da OO - programe para uma interface, nunca para uma implementacao completa */ 

 /* programar para uma interface que somente é um contrato generico para sua classe */

interface DInterface {
    public function hello();
}

/* toda classe que eu for criar que implementar isso vai ter que ter o metodo hello
caso contrario nem vai funcionar  */


class D implements DInterface{

    public function hello(){
        return "Hello";
    }
}

class E  {

    private $d;

    public __construct(DInterface $d){
        $this->d = $d;
    }

    public function test(){
        $this->d->hello();
    }
}

/***
  agora estamos falando de uma classe desacoplada (E), afinal se vc levar a classe E 
  para um outro local, e (vc leva sua interface junto), e QUALQUER obj que implemente 
  essa interface vai poder ser usada em conjunto com a sua classe E 

  a classe A é substituivel 

  ou seja DESACOPLOU 
 */

class F implements DInterface{

    public function hello(){
        return "Hello Melhorado";
    }
}

$d = new D;
$e = new E($d);*79
$f = new E($f);

/**1 ex: vc sempre dependeria onde B extendia da implementacao concreta de A 
 * 2 ex: vc injetou dependencia mas mesmo assim manteve o acoplamento D e E
 * 3 ex: com uma interface. agora vc pode levar E e a interface. que no caso
 * taca um fodase pra classe D (classe concreta).
 */