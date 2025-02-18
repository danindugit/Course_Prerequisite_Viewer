<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Egor's PHP Demo</title>
    </head>

    <body>
        <style>
            @-webkit-keyframes fadeOut {
                0% { opacity: 1;}
                99% { opacity: 0.01;width: 100%; height: 100%;}
                100% { opacity: 0;width: 0; height: 0;}
            }  
            @keyframes fadeOut {
                0% { opacity: 1;}
                99% { opacity: 0.01;width: 100%; height: 100%;}
                100% { opacity: 0;width: 0; height: 0;}
            }

            @keyframes fadeIn {
                0% { opacity: 0; }
                100% { opacity: 1; }
            }
        </style>

        <?php
            include '../../components/navbar.php';
        ?>
        
        <div class="mt-5 d-flex flex-column align-items-center justify-content-center">
            <h1 class="mb-5">To Do List</h1>
            <div>
                <div class="d-flex">
                <input id="input" type="text" class="input-group-text me-2" placeholder="new item"/>
                <button id="add" type="button" class="btn btn-success">Add</button>
                </div>
                
                <div id="todos"></div>
            </div>
        </div>

        <span class="position-fixed bottom-0 end-0 m-2">Egor Ivanov</span>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        
        <script>
            let todos = [{id: 1, todo: "apple"}, {id: 2, todo: "milk"}]
            const todosDOM = document.getElementById("todos")
            const addBtnDOM = document.getElementById("add")
            const inputDOM = document.getElementById("input")

            const updateUI = ()=>{
                todosDOM.innerHTML = ""
                todos.forEach((todo)=>{
                const node = document.createElement("div");
                node.classList.add("todo")
                node.innerHTML = 
                    `
                    <div id="${todo.id}" class="card mt-2 mb-2">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <span class="fs-3">${todo.todo}</span>
                        <button onclick="deleteTodo(${todo.id})" type="button" class="btn btn-danger">X</button>
                    </div>
                    </div>
                    `
                todosDOM.appendChild(node)
                })
            }


            //Add To Do
            addBtnDOM.addEventListener("click", ()=>{
                const id = new Date().valueOf()
                todos.push({
                id: id,
                todo: inputDOM.value
                })
                inputDOM.value = ""
                updateUI()

                const todoCard = document.getElementById(id)
                todoCard.style.webkitAnimation = "fadeIn 1s"
                todoCard.style.animation = "fadeIn 1s"
                todoCard.style.animationFillMode = "forwards"
            })

            const deleteTodo = (id) =>{
                const todoCard = document.getElementById(id)
                todoCard.style.webkitAnimation = "fadeOut 0.5s"
                todoCard.style.animation = "fadeOut 0.5s"
                todoCard.style.animationFillMode = "forwards"

                setTimeout(() => {
                todos = todos.filter((todo)=>todo.id != id)
                updateUI()
                }, 500);
            }

            //Main
            updateUI()
        </script>
    </body>
</html>