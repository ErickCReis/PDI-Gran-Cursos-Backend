## PHP Parallel: Processos, Threads e Channels
---

#### Aula 01: Conceitos iniciais
- Aprendemos por alto o que é a programação paralela e seu propósito;
- Vimos que o PHP já funciona de forma paralela na Web;
- Conhecemos o PHP-FPM;
- Instalamos o PHP com ZTS habilitada;
- Instalamos e habilitamos a extensão `parallel` para criar threads;
- Criamos nossa primeira tarefa paralela, ou seja, nossa primeira thread.

#### Aula 02: Estressando a CPU
- Aprendemos a redimensionar imagens utilizando a extensão GD;
- Vimos que redimensionar imagens é um processo custoso para a CPU;
- Fizemos com que cada imagem fosse redimensionada em uma thread separada;
- Aprendemos que cada thread roda em um núcleo diferente do processador;
- Conseguimos configurar um arquivo para ser executado de início na nova thread;
- Vimos por alto sobre escalonamento de processos.

#### Aula 03: Valores futuros
- Praticamos a criação de runtimes e threads com PHP;
- Aprendemos diversas limitações da extensão `parallel`;
- Conseguimos pegar valores de retorno de uma thread com a classe `Future`.