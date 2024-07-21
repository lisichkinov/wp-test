import React, { useState, useEffect } from 'react'
import { __ } from '@wordpress/i18n'

import Answer from './Answer'

const Question = ( { question, addAnswer } ) => {

  return (
    <li>
      <input type="text" defaultValue={question.text} onChange={(e) => question.text = e.target.value} />
      <ul className="answers">
        { question.answers?.map( ( answer ) => <Answer answer={ answer } /> ) }
      </ul>
      <button onClick={(e) => addAnswer(e, { text: '' } ) }>{__( 'Add answer', 'lisi4-hello' )}</button>
    </li>
  )
}

export default Question