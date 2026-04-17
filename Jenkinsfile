pipeline {
    agent any

    stages {
        stage('Checkout Code') {
            steps {
                git 'https://github.com/Jana-jana43/winngoo-coin-new.git'
            }
        }

        stage('Build Docker Image') {
            steps {
                sh 'docker build --no-cache -t coin-project .'
            }
        }

        stage('Remove Old Container') {
            steps {
                sh 'docker rm -f coin-container || true'
            }
        }

        stage('Run Container') {
            steps {
                sh 'docker run -d -p 80:80 --name coin-container coin-project'
            }
        }

        stage('Verify') {
            steps {
                sh 'docker ps'
            }
        }
    }
}
