const tbody = document.querySelector("#users-tbody");
const pagination = document.querySelector(".pagination");
const form = document.querySelector("#user-form");
const closeModal = document.querySelector(".close");
const phoneInput = document.querySelector("#phone");

IMask(phoneInput, { mask: "(00) 00000-0000", min: 11 });

let currentPage = 1;

const createPagination = (data) => {
    pagination.innerHTML = "";
    pagination.innerHTML += `
    <li class="page-item ${!data.prev_page_url ? "disabled" : ""}">
        <a class="page-link" href="#" onclick="getUsers(${
            data.current_page - 1
        })">Anterior</a>
    </li>
    `;
    for (let i = 1; i <= data.last_page; i++) {
        pagination.innerHTML += `
        <li class="page-item ${data.current_page === i ? "active" : ""}">
            <a class="page-link" href="#" onclick="getUsers(${i})">${i}</a>
        </li>
        `;
    }
    pagination.innerHTML += `
        <li class="page-item ${!data.next_page_url ? "disabled" : ""}">
            <a class="page-link" href="#" onclick="getUsers(${
                data.current_page + 1
            })">Próxima</a>
        </li>
    `;
};

const createtbody = (data) => {
    tbody.innerHTML = "";
    if (!data.data.length) {
        const tr = document.createElement("tr");
        tr.innerHTML = `<td class="text-center text-secondary" colspan="5">Nenhum usuário</td>`;
        tbody.append(tr);
    }
    data.data.forEach((u) => {
        const tr = document.createElement("tr");
        tr.innerHTML = `
        <td>${u.name}</td>
        <td>${u.email}</td>
        <td>${u.phone}</td>
        <td>${u.level === "F" ? "Free" : "Premium"}</td>
        <td class="text-center"><button onclick="${
            u.level === "F" ? `upgrade('${u.id}')` : `downgrade('${u.id}')`
        }" class="btn btn-sm ${
            u.level === "F" ? "btn-success" : "btn-danger"
        }">${u.level === "F" ? "Upgrade" : "Downgrade"}</button</td>
        `;
        tbody.append(tr);
    });
};

const getUsers = (page) => {
    if (page) currentPage = page;
    fetch(`/users?page=${currentPage}`)
        .then((res) => res.json())
        .then((res) => {
            createPagination(res);
            createtbody(res);
        });
};

const downgrade = (id) => {
    fetch(`/users/${id}/downgrade`, { method: "PUT" }).then((res) =>
        getUsers()
    );
};

const upgrade = (id) => {
    fetch(`/users/${id}/upgrade`, { method: "PUT" }).then((res) =>
        getUsers()
    );
};

const getForm = () => {
    return [...form.querySelectorAll("input, select")].reduce((data, item) => {
        data[item.id] = item.value;
        if (i.id === "phone") data[item.id] = item.unmaskedValue;
        return data;
    }, {});
};

form.addEventListener("submit", (e) => {
    e.preventDefault();
    const data = getForm();
    fetch(`/users`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data),
    }).then((res) => {
        closeModal.click();
        form.reset();
        getUsers();
    });
});

getUsers();
