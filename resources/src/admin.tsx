import React, { useState, useEffect } from 'react'
import ReactDOM from 'react-dom'
import { __ } from '@wordpress/i18n'

import Question from './components/Question'
import { TQuestion } from './models/question'

const container = document.getElementById( 'quiz-admin-questions' )
const config = JSON.parse( container?.dataset?.config ?? '[]' )

const App = () => {
    const [ questions, setQuestions ] = useState<TQuestion[]>( JSON.parse( config.questions) ?? [] )

    const addQuestion = ( event, question ) => {
      event.preventDefault()
      setQuestions( [ ...questions, question ] )
    }

    const addAnswer = ( event, question, answer ) => {
      event.preventDefault()

      const updatedQuestions = questions.map(q => {
        if (q.text === question.text) {
          return {
            ...question,
            answers: [ ...question.answers, answer ]
          }
        } else {
          return question
        }
      })
      setQuestions(updatedQuestions)
    }

    return (
      <>
        <input type="hidden" name="questions" value={ JSON.stringify( questions ) } />
        <ul className="questions">
          { questions?.map( ( question ) => <Question question={ question } addAnswer={(e, answer) => addAnswer(e, question, answer)} /> ) }
        </ul>
        <button onClick={ (e) => addQuestion(e, { text: '', answers: [] } ) }>{__( 'Add question', 'lisi4-hello' )}</button>
      </>
    )
}

ReactDOM.render( <App />, container )