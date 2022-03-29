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