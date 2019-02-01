#Library

develop: [![Build Status](https://travis-ci.org/realejo/library.png?branch=develop)](https://travis-ci.org/realejo/library)
master: [![Build Status](https://travis-ci.org/realejo/library.png?branch=master)](https://travis-ci.org/realejo/library)

[![Coverage Status](https://coveralls.io/repos/github/realejo/library/badge.svg?branch=master)](https://coveralls.io/github/realejo/library?branch=master)


Biblioteca com funções comuns

### CPF/CNPJ/CNH
Permite a validação e formatação de CPF, CNPJ e CNH

### CEP/RG/CREA/Phone
Permite formatação de CEP, RG*, CREA e Phone(fixo e celular)

### Image
Permite a manipilação de imagens

### Math
Funções matemáticas que não existem módulo stats do PHP: moda e mediana

### String
Manipulição de strings: remover acentos, criar slug, detectar e converter para UTF8, etc

### UF
Manipulação das unidades federativas do Brasil. Não se chama estado por que DF não é estado.


*Por enquanto a validação do RG só funciona para o orgão SSP-SP, os demais não se enquadram nessa validação, só usam a validação por quantidade de caracteres, a maioria dos estados ainda está usando 9 caracteres, mas ja tem estados usando 10.
