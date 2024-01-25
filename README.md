# API de simulação de crédito GOSAT!

Projeto que consiste em realizar uma API para consulta de crédito, clone o projeto e instale as dependencias através do composer.

### Uso das rotas:

**'/api/credito'**

POST: Essa rota recebe um cpf e retorna as instituições financeiras e tipo de crédito oferecido para o cpf fornecido. Segue exemplo de corpo da requisição:

```json
{
  "cpf":"11111111111"
}
´´´

Essa rota também aceita o cpf em formato com "." e "-", como exemplificado abaixo:

```json
{
  "cpf":"123.123.123-12"
}
´´´

**'/api/oferta'**

POST: Essa rota recebe o cpf, id da instituição financeira e o código da modalidade de crédito, ela retorna informações específicas sobre essa oferta de crédito. Segue exemplo de corpo da requisição:

```json
{
  "cpf": "11111111111",
  "instituicao_id": 2,
  "codModalidade": "a50ed2ed-2b8b-4cc7-ac95-71a5568b34ce"
}
´´´

**'/api/simulacao'**

POST: Essa rota recebe um cpf e retorna três ofertas de crédito para o cpf informado, com informações específicas sobre quantidade de parcelas, total de valor a ser pago, entre outras. O corpo da requisição é identico ao da rota "/api/credito".
