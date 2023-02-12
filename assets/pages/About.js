import React from 'react'
import Layout from "../components/Layout"
import Header from '../components/Header'

function About() {

    return (
        <Layout>
            <Header/>
            <div className="container">
                <h2 className="text-center mt-5 mb-3">About Page</h2>
            </div>
        </Layout>
    );
}

export default About;