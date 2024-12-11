import {React,useState} from "react";
import DataTable from "react-data-table-component";



const App = () => {

    const [value, setValue]=useState("");
    const [film, setFilm]=useState("");


    const handleChange=(value)=>{
        setValue(value); // enlever après
    }

    const handleClick =()=>{

        fetch("https://api.themoviedb.org/3/search/movie?api_key=f33cd318f5135dba306176c13104506a&query="+value)
        .then((response)=>{ return response.json()})
        .then((data)=>{ setFilm(data.results || []);
            console.log(film);
        })
        .catch(function (error){ console.log(error); }) 


    }
    const columns=[
        {
            name: <b>Titre</b>,
            selector: (row)=>row.title,
            sortable:true,
        },
     
      
    ]

    return(
        <>
        <h1 className="text-center titre">Recherchez votre film</h1>
        <div className="d-flex justify-content-center my-3" ><input type="text" className="inputFormulaire" onChange={handleChange} /><button type="submit" onClick={handleClick} className="btn btn-dark"> Rechercher </button></div>
        <DataTable
            columns={columns}
            data={film}
            defaultSautFieldId={0}>
        </DataTable>
        </>
    )
}
export default App;






























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

