## PHP Composer: Dependências, Autoload e Publicação
---

#### Aula 01: Instalando o Composer
- Composer é um gerenciador de dependências PHP.
- Ele guarda as dependências dentro do projeto.
- Se quisermos uma dependência global, devemos usar o _global command_.
- Um pacote sempre segue a nomenclatura: `<vendor>/<name>`.
- As meta-informações de uma dependência ficam salvas no arquivo `composer.json`.
- O comando `composer init` inicializa o `composer.json`.

#### Aula 02: Gerenciando dependências
- O composer possui um repositório central de pacotes: https://packagist.org/.
- É possível configurar repositórios de outras fontes (do github, zip etc).
- O pacotes `guzzlehttp/guzzle` serve para executar requisições HTTP de alto nível.
- Para instalar uma dependência (pacote) basta executar: `composer require <nome do pacote>`.
- Composer guarda as dependências e dependências transitivas na pasta `vendor` do projeto.
- O nome e versão da dependências fica salvo no arquivo `composer.json`.
- O comando `require` adiciona automaticamente a dependência no `composer.json`.
- O comando composer install automaticamente baixa todas as dependências do `composer.lock` (ou do `composer.json`, caso o `.lock` não exista ainda).
- O arquivo `composer.lock` define todas as versões exatas instaladas.
- O composer já gera um arquivo `autoload.php` para facilitar o carregamento das dependências.
- Basta usar `require vendor/autoload.php`.

#### Aula 03: Entendendo Autoload
- Conhecemos a PSR-4 (_Autoloader_).
- A PSR-4 define um padrão para o carregamento automático de classes.
- O namespace da classe tem partes:
  - O `vendor namespace` (ou namespace padrão ou _namespace prefixo_).
    - O `vendor namespace` fica mapeado para uma pasta do projeto dentro do arquivo `composer.json`.
  - Podemos ter um _sub-namespace_ que precisa ser representado através de pastas.
- Para atualizar o arquivo `autoload.php` baseado no `composer.json`, podemos rodar o comando `composer dumpautoload`.
- Para classes que não seguem o PSR-4, podemos definir um `classmap` dentro do `composer.json`.
- Para carregar um biblioteca de funções automaticamente, podemos adicionar uma entrada `files` no `composer.json`.

#### Aula 04: Ferramentas de qualidade de código
- Através do flag `--dev` definimos que uma dependência não faz parte do ambiente de produção.
- Caso desejarmos baixar as dependências de "produção" apenas podemos usar o flag `no-dev`.
- Arquivos executáveis fornecidos por componentes instalados pelo composer ficam na pasta `vendor/bin`.
- Conhecemos três ferramentas do mundo PHP:
  - _phpunit_ para rodar testes;
  - _phpcs_ para verificar padrões de código;
  - _phan_ para executar uma análise estática da sintaxe do nosso código.

#### Aula 05: Automatizando os processos com scripts
- scripts são definidos dentro do `composer.json`.
- scripts podem definir comandos que chamam ferramentas instaladas pelo Composer.
- scripts podem chamar comandos do sistema operacional.
- scripts podem chamar códigos PHP.
- scripts podem ser associados ao evento.

#### Aula 06: Publicando um pacote
- O composer entende as tags de versão de um repositório Git.
- O composer segue o conceito do versionamento semântico (_MAJOR.MINOR.PATCH_).
- No `composer.json` podemos definir constraints (mais detalhes em https://getcomposer.org/doc/articles/versions.md).
- Para distribuir e disponibilizar o seu projeto devemos:
  - Criar um repositório no Github;
  - Usar o packgist e associar com o repositório no Github.
