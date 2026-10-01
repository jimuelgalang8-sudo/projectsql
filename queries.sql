```sql
-- APARTMENT MANAGEMENT SYSTEM
-- SQL QUERY DEMONSTRATIONS


-- 1. SELECT
-- Display all tenants

SELECT * FROM tenants;


-- 2. WHERE
-- Display available units

SELECT *
FROM units
WHERE status = 'Available';


-- 3. ORDER BY
-- Display units from highest rent to lowest rent

SELECT *
FROM units
ORDER BY monthly_rent DESC;


-- 4. GROUP BY
-- Count the number of units for each status

SELECT status, COUNT(*) AS total_units
FROM units
GROUP BY status;


-- 5. JOIN
-- Display tenant, unit, and lease information

SELECT
    tenants.first_name,
    tenants.last_name,
    units.unit_number,
    leases.start_date,
    leases.end_date
FROM leases
INNER JOIN tenants
    ON leases.tenant_id = tenants.tenant_id
INNER JOIN units
    ON leases.unit_id = units.unit_id;


-- 6. INSERT
-- Example of adding a tenant
-- This is an example only.
-- Do not run it again if you do not want another record.

INSERT INTO tenants
(first_name, last_name, contact_number, email, address)
VALUES
('Test', 'Tenant', '0000000000', 'test@example.com', 'Test Address');


-- 7. UPDATE
-- Example of updating the test tenant

UPDATE tenants
SET contact_number = '09123456789'
WHERE first_name = 'Test'
AND last_name = 'Tenant';


-- 8. DELETE
-- Example of deleting the test tenant

DELETE FROM tenants
WHERE first_name = 'Test'
AND last_name = 'Tenant';
```
