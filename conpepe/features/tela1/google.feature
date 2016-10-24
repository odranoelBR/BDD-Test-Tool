#language: pt
Funcionalidade: teste

@parallel-scenario
@javascript
Cenário: Continuacao1
  Dado Eu estou em "/"
  E que existem uns "asa" com valores:
    | nome |
    | foo  |
    | leo  |
  E espero "1" segundo
  Então Eu devo ver "Últimas noticias"

@parallel-scenario
@javascript
Cenário: Continuacao2
  Dado Eu estou em "/"
  E espero "1" segundo
  Então Eu devo ver "Últimas noticias"

@parallel-scenario
@javascript
Cenário: Continuacao3
  Dado Eu estou em "/"
  E espero "1" segundo
  Então Eu devo ver "Últimas noticias"
