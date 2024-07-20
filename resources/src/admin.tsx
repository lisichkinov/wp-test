import React, { useState, useEffect } from 'react'
import ReactDOM from 'react-dom'

import Question from './components/Question'

const container = document.getElementById( 'quiz-admin-questions' )
const config = JSON.parse( container?.dataset?.config ?? '[]' )

const App = () => {
    const [ questions, setQuestions ] = useState( config.questions )

    const addQuestion = ( question ) => {
      setQuestions( [ ...questions, question ] )
    }

    return (
      <>
        <ul>
          { questions?.map( ( question, index ) => <Question key={ index } question={ question } /> ) }
        </ul>
        <button onClick={ () => addQuestion( { text: '', answers: [] } ) }>Add</button>
      </>
    )
}

ReactDOM.render( <App />, container )