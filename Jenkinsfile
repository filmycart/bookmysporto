pipeline {
    agent any

    environment {
        DEPLOY_DIR = '/var/www/dev.sportify' // adjust as needed
    }

    stages {

        stage('Checkout') {
            steps {
                git credentialsId: 'ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAACAQDxU5zrRBVnhAOY2gvUUgLjyBxn3+tUu9gR9UNE786UNin+utFiZcUE0JEbo3Qpwn6mk5r/b1QRA9lIdjSKIL6a4FzvVR5drZobdB+A6bKwmTKMSs93qzEOpoWqvgRr/Rrdfr/4ggsftLck6YejoKZYKuCmK4HfN8lMFKSHMmgRo2oeubiaEzbAMw2vRd4b0WTGcRaaI2RASv02MtZrUYWhMr9v7/rEDFjB/mdEgajS/FJuJf7PlC+G6GsmHy8jV7eUlW3nolB7AefRp9XdZkT3ok0p/t9OMqBVXzBmT7cOiqpT0ElexcsgoprnlwRkR0uI995Nx5N7RjDIXFn5JOSFIAvJ72oPeHeuZ7J5/l184bccvYAG50asYQE3M4dPRfSlKx9/Im333p6to9wSEMoYlGNA87izlhqiFI4snrnBTj6D4R5g3wsoThq2W0w54fufcqfasyG13sH2mxOB0/6UbQ07xcfdSGZS8MsfXFdGav5DVTzyWJE+HXtJ57U2uz8ZJkmHGNG6X9OLbs4OiTHTtl3I6JTJYDm7bhDq+nSQpb+l9BwpMDvtr/lIFSfv7BkfivbqwFlelxxRujeJ/E0pJLn948Cvpf9ZReJljTVFNWRjA5QADMiOQtWlKfdhZXqYTg1qY2hv3ojAkfaWGc/CLvEHAu316+hNzuvPcs9kmQ== filmycartin@gmail.com', url: 'git@github.com:filmycart/sportifyv2.git', branch: 'dev'
            }
        }

        stage('Install Dependencies') {
            steps {
                sh 'composer install --no-interaction --prefer-dist'
            }
        }

       /* stage('Run Tests') {
            steps {
                sh 'vendor/bin/phpunit tests' // assumes PHPUnit is installed via composer
            }
        }*/

        stage('Deploy') {
            steps {
                sshagent(credentials: ['Nachiyar@1984']) {
                    sh """
                        rsync -avz --delete ./ root@97.74.90.174:/var/www/dev.sportify
                        ssh root@97.74.90.174 'cd /var/www/dev.sportify && composer install --no-dev --optimize-autoloader'
                    """
                }
            }
        }
    }

    post {
        success {
            echo 'Deployment successful!'
        }
        failure {
            echo 'Deployment failed.'
        }
    }
}
