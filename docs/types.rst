
Mapping Matrix
--------------

The matrix contains the mapping information for how a specific Doctrine
type is mapped to the database and back to PHP.
Please also notice the mapping specific footnotes for additional information.

+-------------------+---------------+------------------------------------------------------+
| Doctrine          | PHP           | Informix type (all supported versions)               |
+===================+===============+======================================================+
| **array**         | ``array``     | *NOT MAPPED*                                         |
+-------------------+---------------+------------------------------------------------------+
| **bigint**        | ``string``    | ``BIGINT`` ``BIGSERIAL`` [^1]                        |
+-------------------+---------------+------------------------------------------------------+
| **binary**        | ``resource``  | ``BYTE``                                             |
+-------------------+---------------+------------------------------------------------------+
| **blob**          | ``resource``  | ``BYTE``                                             |
+-------------------+---------------+------------------------------------------------------+
| **boolean**       | ``boolean``   | ``BOOLEAN``                                          |
+-------------------+---------------+------------------------------------------------------+
| **date**          | ``\DateTime`` | ``DATE``                                             |
+-------------------+---------------+------------------------------------------------------+
| **datetime**      | ``\DateTime`` | ``DATETIME``                                         |
+-------------------+---------------+------------------------------------------------------+
| **datetimetz**    | ``\DateTime`` | *NOT MAPPED*                                         |
+-------------------+---------------+------------------------------------------------------+
| **decimal**       | ``string``    | ``NUMERIC(p, s)`` [^2] [^3]                          |
+-------------------+---------------+------------------------------------------------------+
| **float**         | ``float``     | ``DOUBLE PRECISION`` [^4]                            |
+-------------------+---------------+------------------------------------------------------+
| **guid**          | ``string``    | *NOT MAPPED*                                         |
+-------------------+---------------+------------------------------------------------------+
| **integer**       | ``integer``   | ``INTEGER`` ``SERIAL`` [^1]                          |
+-------------------+---------------+------------------------------------------------------+
| **json_array**    | ``array``     | *NOT MAPPED*                                         |
+-------------------+---------------+------------------------------------------------------+
| **object**        | ``object``    | *NOT MAPPED*                                         |
+-------------------+---------------+------------------------------------------------------+
| **smallint**      | ``integer``   | ``SMALLINT``                                         |
+-------------------+---------------+------------------------------------------------------+
| **string** [^9]   | ``string``    | ``CHAR(n)`` [^5] [^7] ``VARCHAR(m)`` [^6] [^8]       |
+-------------------+---------------+------------------------------------------------------+
| **text**          | ``string``    | ``TEXT``                                             |
+-------------------+---------------+------------------------------------------------------+
| **time**          | ``\DateTime`` | ``DATETIME HOUR TO SECOND``                          |
+-------------------+---------------+------------------------------------------------------+

Please, for more information see the
[Doctrine\DBAL documentation](http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/types.html)
for data types.

[^1] Used if **autoincrement** attribute is set to ``true`` in the column definition (default ``false``).
[^2] **p** is the precision and **s** the scale set in the column definition.
     The precision defaults to ``10`` and the scale to ``0`` if not set.
[^3] The NUMERIC data type is a synonym for fixed-point DECIMAL.
[^4] The DOUBLE PRECISION type is a synonym for FLOAT.
[^5] Chosen if the column definition has the **fixed** attribute set to ``true`` (default ``false``).
[^6] Chosen if the column definition has the **fixed** attribute set to ``false`` (default).
[^7] **n** is the **length** attribute set in the column definition (defaults to 255 if omitted).
[^8] **m** is the maximum size of the column (defaults to 255 if omitted).
[^9] Silently maps to the ``text`` type if the given **length** attribute for **n** or **m**
     is greater than 255.
