### PickPallet
Web app que contém diversas paletas de cores desenvolvida especialmente para designers.

### Sobre o PickPallet
Resumidamente, este projeto é um "clone" de ColorHunt. Ambas web app's possuem as mesmas intenções: reunir diversas paletas afim de ajudar designers e artistas.
Qualquer usuário pode criar qualquer paleta, visualizar qualquer paleta, e até mesmo copiar o link da paleta através de um simples botão e copiar, também,
cada cor de cada paleta, basta clicar no hexadecimal de cada cor. 
 
 
### A API
Esta API foi desenvolvida através do Wordpress. Caso você pretenda utilizá-la como seu tema, basta clonar este repositório e [adicionar](https://www.wpbeginner.com/beginners-guide/how-to-install-a-wordpress-theme/) nos temas do Wordpress.

API desenvolvida para o projeto "PickPallet". Desenvolvida com PHP.

*Você pode conferir o front-end da aplicação [aqui](https://github.com/CaioAugustoo/pick_pallet).*

### Rotas

- https://caiohtml.com/pickpallet/json/api/pallets 
- https://caiohtml.com/pickpallet/json/api/pallets/:id


### Métodos HTTPS disponíveis:


- GET

    Por padrão o método é o GET. Este método lista, incialmente, 18 paletas. Um pouco mais abaixo você pode conferir os parâmetros.
           
    Exemplo de um trecho de código utilizando o método GET:

     ```javascript
      const fetchPallets = async () => {
        const response = await fetch(
          "https://caiohtml.com/pickpallet/json/api/pallets"
        );
        const json = await response.json();
        console.log(json);
      };
      fetchPallets();
    ```
    
    Como citado anteriormente, o método padrão é o GET, então não precisamos especificar o mesmo. 

    
    Caso queira pegar uma paleta específica, você deve informar o ID da mesma. 
    Exemplo: 
    
    ```javascript
      const fetchPallets = async () => {
        const response = await fetch(
          "https://caiohtml.com/pickpallet/json/api/pallets/102"
        );
        const json = await response.json();
        console.log(json);
      };
      fetchPallets();
    ```
    *PS: o tipo de dado esperado é de number. Qualquer outro tipo retornará a mensagem "No route was found matching the URL and request method."
  
   Retorna:
   
   ```javascript
    {
      "id": 102,
      "created_at": "2021-01-25 09:11:08",
      "pallet1": "#4f4dff",
      "pallet2": "#01bc39",
      "pallet3": "#6aa300",
      "pallet4": "#fe3485"
     }
   ```
    onde: 
    
      - id: número único identificador.
      - created_at: data de quando a paleta foi criada.
      - pallet1: string da primeira paleta.
      - pallet2: string da segunda paleta.
      - pallet3: string da terceira paleta.
      - pallet4: string da quarta paleta.
      
    
- POST
   
    Para publicar uma nova paleta você deve enviar o método POST com o seguinte body/corpo:
     - pallet1: "#corPaleta1",
     - pallet2: "#corPaleta2",
     - pallet3: "#corPaleta3",
     - pallet4: "#corPaleta4"
     
     Deve respeitar o seguinte padrão de regex:    /#([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?\b/
     
     Exemplo de um trecho de código utilizando o método POST:

     ```javascript
      const fetchPallets = async () => {
        const response = await fetch(
         "https://caiohtml.com/pickpallet/json/api/pallets",
          {
            method: "POST",
            headers: { 
              "Content-Type": "application/json" 
          },
          body: JSON.stringify({
            pallet1: "#00af91",
            pallet2: "#007965",
            pallet3: "#f58634",
            pallet4: "#ffcc29",
          }),
        }
      );
      const json = await response.json();
      console.log(json);  // retorna um number de valor: 126
    };
    fetchPallets();
    ```
    
    Após o POST de uma nova paleta é retornado um ID da mesma criada (caso sucesso). No exemplo citado acima foi retornado o valor 126.
 
 
- DELETE
  
  Este método consiste em deletar uma paleta específica. O mesmo só funcionará no modo local (caso você clone este repositório) e não afetará o [projeto real](https://github.com/CaioAugustoo/pick_pallet).
  Para deletar uma paleta você deve informar o método DELETE e informar o ID da paleta que deseja deletar após o */pallets/ID-DA-PALETA-VAI-AQUI*
  
  Exemplo de um trecho de código utilizando o método DELETE:

     ```javascript
      const deletePalletById = async () => {
        const response = await fetch(
          "http://localhost:10004/json/api/pallets/356",
          {
            method: "DELETE",
            headers: {
              "Content-Type": "application/json"
            }
          }
        );
        const json = await response.json();
        console.log(json);
      };
    deletePalletById();
    ```
    
    Caso sucesso, retornará a seguinte mensagem: "Paleta deletada."
    
 ### Parâmetros
  - ?_total
      * https://caiohtml.com/pickpallet/json/api/pallets?_total=18  // por padrão o valor é 18. Você pode substituir por 32, por exemplo. 
       
  - ?_page
       * https://caiohtml.com/pickpallet/json/api/pallets?_page=3   // por padrão o valor é 1. Você pode substituir por 5, por exemplo. 
       
       
    Caso seja de sua vontade, você pode utilizar os 2 parâmetros na mesma url: 
    
     - https://caiohtml.com/pickpallet/json/api/pallets?_total=32&_page=2
     
### Mensagens de erros
 - "Verifique se não deixou algum campo vazio ou não inseriu um hexadecimal incorreto."
 
      É retornado quando algum campo não foi preenchido corretamente. Verifique, também, se você utilizou headers (apenas para métodos POST e DELETE).

 - "Valor hexadecimal inválido."
 
     É retorando quando, ao adicionar uma nova paleta, não foi inserido corretamente o valor hexadecimal. Deve respeitar o seguinte padrão de regex:    /#([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?\b/
     
     
 - "Paleta não encontrada"
     
     É retornado quando a paleta não é encontrada, isso significa que ela ainda não existe. Verifique se o ID passado na url é válido.

- "No route was found matching the URL and request method."
    
    É retornado quando a rota é inexistente. Verifique se inseriu corretamente a URL ou se passou um ID válido para uma paleta (caso esteja procurando por uma paleta específica).
   
   
 ### Contribuições
 
   Caso pretenda contribuir para este projeto, sinta-se livre para enviar pull request's. 
   Caso tenha algum problema envie uma nova issue.
 
 
 ### Licença
 
 Copyright © 2021 Caio Augusto.
