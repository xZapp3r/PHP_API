<?php
if (PHP_SAPI != 'cli') {
  exit('Rodar via CLI');
}

require __DIR__ . '/vendor/autoload.php';


// Instantiate the app
$settings = require __DIR__ . '/src/settings.php';
$app = new \Slim\App($settings);

$dependencies = require __DIR__ . '/src/dependencies.php';

$container = $dependencies($app);

$db = $container->get('db');

$schema = $db->schema();
$tabela = 'produtos';

$schema->dropIfExists( $tabela );

$schema->create($tabela, function($table){
  $table->increments('id');
  $table->string('titulo', 100);
  $table->text('descricao');
  $table->decimal('preco', 11, 2);
  $table->string('fabricante', 60);
  $table->date('dt_criacao');
});

$db->table($tabela)->insert([
  'titulo' => 'SmarthPhone Motorola Moto G6 32GB Dual Chip',
  'descricao' => 'Android Oreo - 8.0 Tela 5.7" Octa-Core, 1.8 Ghz 4G Camer 12 + 5MP (Dual Traseira) - Indigo',
  'preco' => 899.00,
  'fabricante' => 'Motorola',
  'dt_criacao' => '2019-10-22'
]);

$db->table($tabela)->insert([
  'titulo' => 'iPhone X Cinza Espacial 64GB',
  'descricao' => 'Tela 5.8" IOS 12 4G Wi-Fi Camera 12MP - Apple',
  'preco' => 4999.00,
  'fabricante' => 'Apple',
  'dt_criacao' => '2020-01-10'
]);