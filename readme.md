PHP DEVELOPER INTERVIEW ASSIGNMENT PROJECT

Thank you for agreeing to do this assignment. The details are below and you will be graded on speed of delivery and overall quality of code. You may use vanilla PHP or the Laravel framework. 

Background: Refersion has the capability to associate specific product purchases to affiliates, however a product to affiliate association must be created first. This way Refersion knows which affiliate to credit the order of that product to. We do this using a Refersion feature called Conversion Triggers. A Conversion Trigger is an association to an affiliate ID to a product SKU. Think of a product SKU as something like a product ID, but more granular. For example, a shop may sell a t-shirt product. That t-shirt may come in different sizes. While the t-shirt product may have an ID of 10000, that t-shirt also has different sizes: small, medium, large. Each of these sizes will may a different SKU under that product ID 10000 (ex., “ts-small-blue” or “ts-large-green”). 

Project Objective: Build an automatic process where whenever there is a new SKU created in Shopify, create a Conversion Trigger in Refersion so that an association to an affiliate is made instantly. 

How To: 

1. Use Shopify's API to create a webhook in the shop for the "products/create" event. Grab the SKU from the product in the JSON that is sent within the webhook. The SKU must have a special format that includes the respective affiliate ID for the Conversion Trigger, such as: 

prod-abc-rfsnadid:12345

In this example, the affiliate ID is 12345. You must look for the "rfsnadid" keyword and then pick up the numeric value after. If "rfsnadid" is not included, ignore this product SKU. 

Relevant Shopify API docs: https://help.shopify.com/api/reference/webhook

Dev shop to run API queries under: https://numa-dev.myshopify.com
X-Shopify-Access-Token: 

Shop login to update/create products and test: https://numa-dev.myshopify.com/admin
Username: 
Password: 

2. Use Refersion's API to create the Conversion Trigger with this affiliate ID. 

Relevant Refersion API docs: https://www.refersion.com/api_docs/#create-conversion-trigger

Refersion test account login: https://www.refersion.com/base
Username: 
Password: 

Refersion API public key: 
Refersion API secret key: 

