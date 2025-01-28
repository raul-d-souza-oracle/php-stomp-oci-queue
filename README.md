# Envio de Mensagens para o Oracle Cloud Queue usando STOMP com PHP 7.1.33

Este projeto demonstra como se conectar ao serviço de filas (Queue) da Oracle Cloud Infrastructure (OCI) usando o protocolo **STOMP** em PHP.

## Requisitos

- **PHP 7.1 ou superior**
- **Composer** (para gerenciar dependências)
- **Biblioteca `stomp-php`** (instalada via Composer)
- OCID da fila no Oracle Cloud
- Nome de usuário e Auth token gerados no Oracle Console

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