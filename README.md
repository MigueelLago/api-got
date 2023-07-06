A API consiste em um [CRUD] onde é possível realizar as operações básicas: [criar], [editar],
[listar] e [deletar]. 

A API é baseada na śerie Game Of Thrones.

**Versão do PHP**: 8.0.2 ou superior  
**Versão do Laravel**: 9.19 ou superior

## Ao clonar o projeto
Ao clonar o projeto execute as seguintes etapas abaixo para executar a aplicação:

> composer install  
> copy .env.example .env  
> php artisan key:generate

## Rotas da aplicação
**Criar Casas**  
**URL**: /admin/houses  
**Método**: POST  
**Método do Controlador**: HousesController@store  
> Esta rota é usada para criar uma nova casa. Ela espera os dados necessários para criar uma casa e os envia para o método store da classe HousesController.

**Lista de Casas**  
**URL**: /admin/houses  
**Método**: GET  
**Método do Controlador**: HousesController@index  
> Esta rota recupera uma lista de todas as casas. Ela chama o método index da classe HousesController para buscar e retornar a lista de casas.

**Lista de Casas**  
**URL**: /admin/houses  
**Método**: GET  
**Método do Controlador**: HousesController@index  
> Esta rota recupera uma lista de todas as casas. Ela chama o método index da classe HousesController para buscar e retornar a lista de casas.

**Buscar uma casa por nome ou ID**  
**URL**: /admin/houses  
**Método**: GET  
**Método do Controlador**: HousesController@index  
**Parâmetros esperados via query params**: _name_ **ou** _id_  
> Esta rota recupera uma lista da casa existente baseada no nome ou ID. Ela chama o método index da classe HousesController e faz uma validação, se houver os parâmetros informados ele retorna a casa, se não houver nenhuma casa com o parâmetro informado ele retorna um array vazio, se não for enviado nenhum parâmetro ele automaticamente lista todas as casas.

**Excluir uma Casa**  
**URL**: /admin/houses/{id}  
**Método**: DELETE  
**Método do Controlador**: HousesController@destroy  
> Esta rota é usada para excluir uma casa específica identificada pelo parâmetro {id}. Ela chama o método destroy da classe HousesController para remover a casa do sistema.

**Atualizar uma Casa**  
**URL**: /admin/houses/{id}  
**Método**: PUT  
**Método do Controlador**: HousesController@update  
> Esta rota é usada para atualizar uma casa específica identificada pelo parâmetro {id}. Ela espera os dados atualizados da casa e os envia para o método update da classe HousesController para processamento.

## Payload a ser enviado via json no Body das requisições POST e PUT
```json
{
	"name": "House Targaryen of King's Landing",
	"region": "The Crownlands",
	"founded_in": "House Targaryen: >114 BCHouse Targaryen of King's Landing:1 AC",
	"lord":{
		"name": "Daenerys Targaryen",
		"gender": "Female",
		"interpretedBy": "Emilia Clarke",
		"titles": [
            "Queen of the Andals and the Rhoynar and the First Men, Lord of the Seven Kingdoms",
            "Khaleesi of the Great Grass Sea",
            "Breaker of Shackles/Chains",
            "Queen of Meereen",
            "Princess of Dragonstone"
		],
		"aliases": [
            "Dany",
            "Daenerys Stormborn",
            "The Unburnt",
            "Mother of Dragons",
            "Mother",
            "Mhysa",
            "The Silver Queen",
            "Silver Lady",
            "Dragonmother",
            "The Dragon Queen",
            "The Mad King's daughter"
		],
		"seasons_appeared": [
		 	"Season 1",
			"Season 2",
			"Season 3",
			"Season 4",
			"Season 5",
			"Season 6"
		]
	}
}
```

**Os seguintes campos são obrigatórios**:  
-- **name**  
-- **region**  
-- **founded_in**  
-- **lord -> name**  
-- **lord -> gender**  
-- **lord ->interpretedBy**  
-- **lord -> seasons_appeared**