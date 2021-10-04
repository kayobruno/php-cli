### PHP CLI Application

------
Requisitos obrigatórios

> **[Docker](https://www.docker.com/)**

> **[Docker Hub](https://hub.docker.com/)**

Todas as imagens utilizadas para a criação dos containers são registradas e foram
utilizadas na versão Alphine para melhorar segurança e eficiência de recursos.
Então será necessário realizar login no DockerHub para conseguir executar a aplicação.

👨‍💻 Execute o comando abaixo para realizar login no DockerHub.
Acesse este [link](https://docs.docker.com/docker-hub/access-tokens/) para mais informações
```
docker login -u seuUsuario
```

👨‍💻 Execute o comando abaixo para inicializar o projeto:
```
docker-compose up -d
```

✅ Executar testes com **PHPUnit**
```bash
docker exec -it php composer test
```

🚀 Execute o comando abaixo para cadastrar usuário:
```bash
docker exec -it php ./ASP-TEST USER:CREATE
```

🚀 Execute o comando abaixo para cadastrar senha de um usuário:
```bash
docker exec -it php ./ASP-TEST USER:CREATE-PWD {ID}
```

