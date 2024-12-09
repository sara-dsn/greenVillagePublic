// import {React,useState} from 'react';

// const App =()=>{

//     const [article, setArticle]=useState('');
//     const [liste , setListe]=useState([]);

//     const handleClick=()=>{
//         setListe([...liste,article]);
//     }
//        const handleInputChange=(valueInput)=>{
//             setArticle(valueInput.target.value);
//         } 
//     return(
//         <div>
//             <input type="text" value={article} onChange={handleInputChange} /><button onClick={handleClick} >Ajouter</button>
//             { liste.map((article)=>(
//                     <li> {article}</li>
//                 ))
//             }
            
//         </div>
//     );

// }
    
// export default App;



// import {React,useState} from 'react';

// const App =()=>{

//     const [chiffre, setChiffre]=useState(0);

//     const handleClick=()=>{
//         setChiffre(chiffre +1);
//     }

//     return(
//         <div>
//             <button onClick={handleClick} > Compteur = {chiffre}</button>
//         </div>
//     );
 
// }
// export default App;


// import {React,useState} from 'react';

// const App =()=>{

//     const[nom, setNom]=useState("");
//     const[prenom, setPrenom]=useState("");

//     const handleChange1=(truc)=>{
//         setNom(truc.target.value);
//     }
//     const handleChange2 = (chose)=>{
//         setPrenom(chose.target.value);
//     }
    
//     return(
//         <div>
//             Bonjour {nom} {prenom}<br/> 
//             <input onChange={handleChange1} placeHolder="Votre nom"></input>
//             <input onChange={handleChange2} placeHolder="Votre prénom"></input>
//         </div>
//     );

// }
// export default App;





// import {React, useEffect, useState} from 'react';

// const App =(props)=>{

//     const[nom , setNom]=useState("");

//     useEffect(()=>{
//         console.log("useEffect 2 ...")
//     },[nom]);

//     useEffect(()=>{
//         console.log("useEffect 1 ...")
//     },[]);

//     const handleClick=()=>{
//         setNom(Math.random().toString(36).replace(/[^a-z+]+/g,''));
//     }
//     console.log("render App...");
//     return (
//         <>
//             <div>
//                 {nom}
//             </div>
//             <button onClick={handleClick}>change le nom </button>
//         </>
//     );
// }

// export default App;



// import {React, useState} from 'react';


// const App =()=>{
//     const[nom , setNom]=useState("");

//     const handleChangeNom =(evt)=>{
//         setNom(evt.target.value);
//     }
//     return (
//         <div>
//             <div>
//                 Bonjour {nom}
//             </div>
//             <input type="text"  value={nom} onChange={handleChangeNom}/>    
//         </div>
//     );
// }


// export default  App ;

