
Mapping Matrix from Doctrine to Informix.
-----------------------------------------

The matrix contains the mapping information for how a specific Doctrine
type is mapped to the database and back to PHP.
Please also notice the mapping specific footnotes for additional information.

| Doctrine          | PHP           | Informix type (all supported versions)               |
|-------------------|---------------|------------------------------------------------------|
| **array**         | ``array``     | ``TEXT``                                             |
| **bigint**        | ``string``    | ``BIGINT`` ``BIGSERIAL`` (1)                         |
| **binary**        | ``resource``  | ``BYTE``                                             |
| **blob**          | ``resource``  | ``BYTE``                                             |
| **boolean**       | ``boolean``   | ``BOOLEAN``                                          |
| **date**          | ``\DateTime`` | ``DATE``                                             |
| **datetime**      | ``\DateTime`` | ``DATETIME``                                         |
| **datetimetz**    | ``\DateTime`` | ``DATETIME YEAR TO SECOND``                          |
| **decimal**       | ``string``    | ``NUMERIC(p, s)`` (2) (3)                            |
| **float**         | ``float``     | ``DOUBLE PRECISION`` (4)                             |
| **guid**          | ``string``    | ``VARCHAR``                                          |
| **integer**       | ``integer``   | ``INTEGER`` ``SERIAL`` (1)                           |
| **json_array**    | ``array``     | ``TEXT``                                             |
| **object**        | ``object``    | ``TEXT``                                             |
| **smallint**      | ``integer``   | ``SMALLINT``                                         |
| **string** (9)    | ``string``    | ``CHAR(n)`` (5) (7) ``VARCHAR(m)`` (6) (8)           |
| **text**          | ``string``    | ``TEXT``                                             |
| **time**          | ``\DateTime`` | ``DATETIME HOUR TO SECOND``                          |


Mapping Matrix from Informix to Doctrine.
-----------------------------------------


| Informix type (all supported versions)                              | Doctrine           |
|---------------------------------------------------------------------|--------------------|
| ``SMALLINT``                                                        | **smallint**       |
| ``INTEGER`` ``SERIAL``                                              | **integer**        |
| ``BIGINT`` ``BIGSERIAL`` ``INT8`` ``SERIAL8``                       | **bigint**         |
| ``DECIMAL(p, s)`` ``MONEY(p, s)`` ``NUMERIC(p, s)`` (3)             | **decimal**        |
| ``DOUBLE PRECISION`` (4) ``FLOAT`` ``SMALLFLOAT``                   | **smallfloat**     |
| ``CHAR(n)`` ``NCHAR(n)`` (7) ``NVARCHAR(m)`` ``VARCHAR(m)`` (8)     | **string**         |
| ``CLOB`` ``LVARCHAR(m)`` (8) ``TEXT``                               | **text**           |
| ``BLOB`` ``BYTE``                                                   | **blob**           |
| ``BOOLEAN``                                                         | **boolean**        |
| ``DATE``                                                            | **date**           |
| ``DATETIME``                                                        | **datetime**       |
| ``DATETIME HOUR TO SECOND``                                         | **time**           |


Please, for more information see the
[Doctrine\DBAL documentation](http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/types.html)
for data types.


1. Used if **autoincrement** attribute is set to ``true`` in the column definition (default ``false``).
2. **p** is the precision and **s** the scale set in the column definition.
   The precision defaults to ``10`` and the scale to ``0`` if not set.
3. The NUMERIC data type is a synonym for fixed-point DECIMAL.
4. The DOUBLE PRECISION type is a synonym for FLOAT.
5. Chosen if the column definition has the **fixed** attribute set to ``true`` (default ``false``).
6. Chosen if the column definition has the **fixed** attribute set to ``false`` (default).
7. **n** is the **length** attribute set in the column definition (defaults to 255 if omitted).
8. **m** is the maximum size of the column (defaults to 255 if omitted).
9. Silently maps to the ``text`` type if the given **length** attribute for **n** or **m**
   is greater than 255.
