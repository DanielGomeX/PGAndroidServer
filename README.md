# AndroidWebServer
- Get Position, each x time per day
- Online Chat
- Store Sales
- UserID


#Database
- tbl_user: id, nome, Login, Senha
- tbl_produto: id,id_user,tipo, nome, valor
- tbl_gps: id,id_user,data, lat, long, enviado(true, false)
- tbl_chat: id,id_user,de, para, message, lat, lng
- tbl_ponto: id,id_user, data, situacao, lat, lng
- tbl_logs: id,id_user, msg, data, lat, lng
- tbl_suport: id,id_user, msg, data, lat, lng, situacao
- tbl_pedido: id,id_user, id_produto, quantidade, situacao, lat, lng, data

#Steps
 - Sincronizar com a Web as tabelas tbl_user e tbl_produtos
 - Permitir login
 - Armazenar posições e ir enviando de tempo em tempo.

 #ToDo(Done)
 - Create users
 - Create users getJson
 - Create User Groups
 - Create Products
 - Create products groups
 - Create products groups getJson
 - Associate Products with groups
 - Create Products getJson
 - Create Cart
 - Recreate menus
 - View Cart
 
  #ToDo(Pendding)  
 - Integrate Open MapStreet
 - Set Point on MapStreet
 - Filter by Agent
 - Filter by hour
 - Create Geolocation


