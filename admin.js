db.createUser({ 
user: "admin" , 
pwd: "p@ssw0rd", 
roles: [{role:"userAdminAnyDatabase", db:"admin"}]})