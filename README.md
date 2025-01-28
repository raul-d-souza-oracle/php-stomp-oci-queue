# Envio de Mensagens para o Oracle Cloud Queue usando STOMP com PHP 7.1.33

Este projeto demonstra como se conectar ao serviço de filas (Queue) da Oracle Cloud Infrastructure (OCI) usando o protocolo **STOMP** em PHP.

## Requisitos

- **PHP 7.1 ou superior**
- **Composer** (para gerenciar dependências)
- **Biblioteca `stomp-php`** (instalada via Composer)
- OCID da fila no Oracle Cloud
- Nome de usuário e Auth token gerados no Oracle Console

## Preparação (Antes de executar o projeto)

1. **Criar uma fila no Oracle Cloud**:
   - Acesse o console da Oracle Cloud.
   - Navegue até a seção de "Filas" (Queues).
   - Clique em "Criar Fila" e preencha os detalhes necessários, como nome e descrição.
   - Anote o OCID da fila criada, pois será necessário para as próximas etapas.
   - Anote o Messages endpoint, pois será necessário para as próximas etapas.

2. **Criar um usuário no Oracle Cloud**:
   - No console da Oracle Cloud, vá para "Identidade" e depois "Usuários".
   - Clique em "Criar Usuário" e forneça um nome e uma descrição.
   - Anote o nome de usuário, pois será necessário para gerar o Auth Token.

3. **Criar um Grupo para acesso a fila**:
   - Ainda na seção de "Identidade", vá para "Grupos".
   - Clique em "Criar Grupo" e forneça um nome e uma descrição.
   - Este grupo será usado para gerenciar permissões de acesso à fila.

4. **Dar permissão para o grupo acessar a fila**:
   - Vá para "Políticas" na seção de "Identidade".
   - Clique em "Criar Política" e forneça um nome e uma descrição.
   - Defina a política para permitir que o grupo criado acesse a fila. Exemplo de política:
     ```
     Allow group <NOME_DO_GRUPO> to manage queues in compartment <NOME_DO_COMPARTIMENTO>
     ```

5. **Adicionar o usuário ao grupo**:
   - Retorne à seção de "Grupos".
   - Selecione o grupo criado e clique em "Adicionar Usuários".
   - Selecione o usuário criado anteriormente e adicione-o ao grupo.

6. **Criar um Auth Token para o usuário**:
   - Vá para "Usuários" e selecione o usuário criado.
   - Clique em "Tokens de Autenticação" e depois em "Gerar Token".
   - Anote o Auth Token gerado, pois será necessário para autenticar o acesso à fila.

7. **Preencha as variáveis das linhas 12, 15, 18, 21 com as informações colhidas nas etapas anteriores**:
   - $brokerUri: Messages endpoint, substituindo o HTTPS por SSL, e adicionando ao final a porta 61613.
   - $username: <TENANCY>/oracleidentitycloudservice/<USER>
   - $password: Auth Token, em base64
   - $queueName: OCID da fila criada

## Instalação

1. **Clone o repositório**:
   ```bash
   git clone <URL_DO_REPOSITORIO>
   cd <NOME_DO_PROJETO>

2. **Instale as dependências**:
   ```bash
   composer install

3. **Execute o projeto**:
   ```bash
   php main.php
   ```
   
4. **Verifique a fila**:
   ```bash
   oci queue get --queue-id <OCID_DA_FILA>
   ```

5. **Verifique a mensagem na fila**:
   ```bash
   oci queue get-messages --queue-id <OCID_DA_FILA>
   ```