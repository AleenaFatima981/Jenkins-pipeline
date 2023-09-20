pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                
                    echo 'mvn clean install'
                }
            
            post {
                success {
                    
                    echo 'Build success!'
                    

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
                    subject: "Tests passed successfully",
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
                    
                    echo 'code analysis completed'
                    
                    
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
                    
                    echo 'Deployment to staging passed!'
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
                    
                    echo 'Integration tests on staging success!'
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
                    
                    echo 'Deployment to production success!'
        
                }
                failure {
                    echo 'Deployment to production failed!'
                }
            }
        }
    }
}
