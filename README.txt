No se modificó la base de datos, porque ya estaba en 3NF.
A continuación se justifica esto, chequeando que la base de datos cumpla con los criterios de las formas normales correspondientes.

Criterios 1NF:

-Eliminate repeating groups in individual tables: En ninguna de las tablas se repiten grupos. CHECK
-Create a separate table for each set of related data: Cada usuario puede teener mas de una tutoria y mas de un review en sus tutorias. Por esto se crean 3 tablas diferentes, de tal forma que no existan columnas multiples para un solo usuario. CHECK
-Identify each set of related data with a primary key: Todos los atributos de las 3 tablas dependen unicamente del id de cada entidad. CHECK

Criterios 2NF:

-1NF CHECK
-No non-prime attribute is dependent on any proper subset of any candidate key of the table: Como solo tenemos un atributo clave (id), este criterio se cumple. CHECK

Criterios 3NF:

-2NF CHECK
-All the attributes in a table are determined only by the candidate keys of that table and not by any non-prime attributes: Los atributos que no son llaves unicamenten contienen informacion que los define a si mismos y no tienen relacion con los otros atributos. CHECK

Como se cumplen todos los criterios podemos decir que la base de datos esta normalizada a 3NF.