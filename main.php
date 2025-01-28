<?php

// Carrega o autoloader gerado pelo Composer para gerenciar dependências (bibliotecas instaladas)
require 'vendor/autoload.php';

// Importa as classes necessárias da biblioteca Stomp
use Stomp\Client;
use Stomp\StatefulStomp;
use Stomp\Transport\Message;

// Define o URI do broker STOMP (protocolo de mensagens usado para conectar ao serviço de filas da Oracle Cloud)
$brokerUri = 'ssl://cell-1.queue.messaging.<REGION>.oci.oraclecloud.com:61613'; // Substitua pela região e porta corretos do Oracle Cloud Queue

// Define o nome de usuário usado para autenticação no STOMP. (Caso não utilize o IDCS, use o usuário do Oracle Cloud)
$username = '<TENANCY>/oracleidentitycloudservice/<USER>'; // Substitua pelo nome de usuário do Oracle Cloud

// Define a senha ou token de autenticação em Base64 (gerada no console do Oracle Cloud)
$password = 'R1RVRkZFNExldVsraVo7Om1zdTM='; // Substitua pelo Auth Token, em base64

// Define o OCID da fila na Oracle Cloud (identificador único da fila configurada no Oracle Cloud)
$queueName = 'ocid1.queue.oc1.sa-saopaulo-1......'; // Substitua pelo OCID correto da fila

try {
    // Cria um cliente STOMP e configura o URI do broker
    $client = new Client($brokerUri);

    // Define o login e a senha para autenticação no broker
    $client->setLogin($username, $password);

    // Estabelece a conexão com o broker STOMP
    $client->connect();

    // Cria uma instância do StatefulStomp para gerenciar operações no STOMP de forma simplificada
    $stomp = new StatefulStomp($client);

    // Cria uma mensagem com o conteúdo "Hello, Oracle Cloud Queue!" e define o tipo de conteúdo como texto simples (plain text)
    $message = new Message('Hello, Oracle Cloud Queue!', ['content-type' => 'text/plain']);

    // Envia a mensagem para a fila especificada pelo OCID
    $stomp->send($queueName, $message);

    // Exibe uma mensagem de sucesso no console
    echo "Message sent successfully!\n";

    // Fecha a conexão com o broker STOMP
    $client->disconnect();
} catch (\Stomp\Exception\StompException $e) {
    // Captura erros relacionados ao STOMP e exibe a mensagem de erro no console
    echo "Error: " . $e->getMessage(). "\n";
}
