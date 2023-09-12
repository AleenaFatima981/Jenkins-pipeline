pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                script {
                    sh 'mvn clean install'
                }
            }
            post {
                success {
                    echo 'Build completed successfully!'
                }
                failure {
                    echo 'Build failed!'
                }
            }
        }

        stage('Unit and Integration Tests') {
            steps {
                script {
                    sh 'mvn test'
                }
            }
            post {
                success {
                    echo 'Tests passed!'
                }
                failure {
                    echo 'Tests failed!'
                }
            }
        }

        stage('Code Analysis') {
            steps {
                script {
                    sh 'mvn sonar:sonar'
                }
            }
            post {
                always {
                    echo 'Code analysis completed!'
                }
            }
        }

        stage('Security Scan') {
            steps {
                script {
                    sh 'mvn org.owasp:dependency-check-maven:check'
                }
            }
            post {
                always {
                    echo 'Security scan completed!'
                }
            }
        }

        stage('Deploy to Staging') {
            steps {
                script {
                    echo 'Deploying to staging...'
                }
            }
            post {
                success {
                    echo 'Deployed to staging successfully!'
                }
                failure {
                    echo 'Deployment to staging failed!'
                }
            }
        }

        stage('Integration Tests on Staging') {
            steps {
                script {
                    echo 'Running integration tests on staging...'
                }
            }
            post {
                success {
                    echo 'Integration tests on staging passed!'
                }
                failure {
                    echo 'Integration tests on staging failed!'
                }
            }
        }

        stage('Deploy to Production') {
            steps {
                script {
                    echo 'Deploying to production...'
                }
            }
            post {
                success {
                    echo 'Deployed to production successfully!'
                }
                failure {
                    echo 'Deployment to production failed!'
                }
            }
        }
    }
}



<!-- pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                script {
                    sh 'mvn clean install'
                }
            }
            post {
                success {
                    echo 'Build completed successfully!'
                }
                failure {
                    echo 'Build failed!'
                }
            }
        }

        stage('Unit and Integration Tests') {
            steps {
                script {
                    sh 'mvn test'
                }
            }
            post {
                success {
                    echo 'Tests passed!'
                }
                failure {
                    echo 'Tests failed!'
                }
            }
        }

        stage('Code Analysis') {
            steps {
                
                script {
                    sh 'mvn sonar:sonar'
                }
            }
            post {
                always {
                    echo 'Code analysis completed!'
                }
            }
        }

        stage('Security Scan') {
            steps {
                
                script {
                    sh 'mvn org.owasp:dependency-check-maven:check'
                }
            }
            post {
                always {
                    echo 'Security scan completed!'
                }
            }
        }

        stage('Deploy to Staging') {
            steps {
                
                script {
                    echo 'Deploying to staging...'
                    
                }
            }
            post {
                success {
                    echo 'Deployed to staging successfully!'
                }
                failure {
                    echo 'Deployment to staging failed!'
                }
            }
        }

        stage('Integration Tests on Staging') {
            steps {
                
                script {
                    echo 'Running integration tests on staging...'
                    
                }
            }
            post {
                success {
                    echo 'Integration tests on staging passed!'
                }
                failure {
                    echo 'Integration tests on staging failed!'
                }
            }
        }

        stage('Deploy to Production') {
            steps {
                
                script {
                    echo 'Deploying to production...'
                    
                }
            }
            post {
                success {
                    echo 'Deployed to production successfully!'
                }
                failure {
                    echo 'Deployment to production failed!'
                }
            }
        }
    }
}
 -->
