import React, { useState, useEffect } from 'react'
import { __ } from '@wordpress/i18n'
import { TAnswer } from '../models/answer'

const Answer: React.FC<TAnswer> = ( { answer } ) => {

  return (
    <li>
      <input type="text" defaultValue={answer.text} onChange={(e) => answer.text = e.target.value} />
    </li>
  )
}

export default Answer