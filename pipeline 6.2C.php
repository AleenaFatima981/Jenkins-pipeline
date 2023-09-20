pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                
                    echo 'mvn clean install'
                }
            
            post {
                success {
                    
                    emailext to: "aleenaf281@gmail.com",
                    subject: "Build completed Email",
                    body: "Build completed completed",
                    attachLog : true
                    

                }
                failure {
                    echo 'Build failed!'
                }
            }
        }

        stage('Unit and Integration Tests') {
            steps {
                 
                echo 'mvn test'
                }
            
            post {
                success {
                    
                    emailext to: "aleenaf281@gmail.com",
                    subject: "Tests passed Email",
                    body: "Tests passed completed",
                    attachLog : true
                }
                failure {
                    echo 'Tests failed!'
                }
            }
        }

        stage('Code Analysis') {
            steps {
                
                    echo 'mvn sonar:sonar'
                
            }
            post {
                always {
                    
                    emailext to: 'aleenaf281@gmail.com',
                    subject: 'Code Analysis completed',
                    body: 'The code analysis is completed.'
                    attachLog : true
                    
                    
                }
            }
        }
        stage('Security Scan') {
            steps {
                    echo 'mvn org.owasp:dependency-check-maven:check'
            }
            post {
                success {
                    
                    emailext to: "aleenaf281@gmail.com",
                    subject: "Security Scan Email",
                    body: "Security Scan completed",
                    attachLog : true
                    
                }
            }
        }

        stage('Deploy to Staging') {
            steps {
                    echo 'Deploying to staging...'

            }
            post {
                success {
                    
                    emailext to: "aleenaf281@gmail.com",
                    subject: "Deploy to Staging Email",
                    body: "Deploy to Staging completed",
                    attachLog : true
                }
                failure {
                    echo 'Deployment to staging failed!'
                }
            }
        }

        stage('Integration Tests on Staging') {
            steps {
                 
                    echo 'Running integration tests on staging...' 
            }
            post {
                success {
                    
                    emailext to: "aleenaf281@gmail.com",
                    subject: "Integration Tests on Staging Email",
                    body: "Integration Tests on Staging completed",
                    attachLog : true
                }
                failure {
                    echo 'Integration tests on staging failed!'
                }
            }
        }

        stage('Deploy to Production') {
            steps {
                
                    echo 'Deploying to production...'
                
            }
            post {
                success {
                    
                    emailext to: "aleenaf281@gmail.com",
                    subject: "Deployed to production successfully Email",
                    body: "Deployement completed",
                    attachLog : true
        
                }
                failure {
                    echo 'Deployment to production failed!'
                }
            }
        }
    }
}
