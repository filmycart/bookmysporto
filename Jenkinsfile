pipeline {
    agent any

    stages {
/*        stage('Project1'){
            steps{
                cleanWs()
                dir('project1') {
                    // Doing your project 1 stuff
                    git(url: 'https://github.com/filmycart/sportifyv2.git', branch: 'dev')
                }
                
            }
        },*/
        stage('Deploy') {
            steps {
                sshagent(credentials: ['Nachiyar@1984']) {
                    sh """
                        ssh root@97.74.90.174 'cd /var/www/dev.sportify && ls'
                    """
                }
            }
        }
    }
}