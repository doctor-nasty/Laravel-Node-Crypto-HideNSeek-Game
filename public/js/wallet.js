const chainIds = { Ethereum: 1, Rinkeby: 4, Polygon: 137, Mumbai: 80001 };

async function getProvider() {
  let provider = undefined;

  if (window.ethereum != undefined) {
    if (window.ethereum.providerMap != undefined) {
      // several wallets are installed - find coinbase wallet
      window.ethereum.providers.forEach((prov) => {
        if (prov.isCoinbaseWallet === true) provider = prov;
      });
    } else {
      // single wallet is installed
      if (window.ethereum.isCoinbaseWallet === true) {
        provider = window.ethereum;
      }
    }
  }

  function nowalletModal() {
    $("#nowallet-modal").modal();
  }

  if (provider == undefined) {
    nowalletModal();
    return;
  }

  // connect to wallet
  try {
    await provider.request({ method: "eth_requestAccounts", params: [] });
  } catch (err) {
    alert("Wallet connection is denied by user");
    return;
  }

  const network = $("#network_id").val();

  const targetChain = chainIds[network];

  // change to polygon network
  if (provider.getChainId() != targetChain) {
    try {
      await provider.request({
        method: "wallet_switchEthereumChain",
        params: [{ chainId: targetChain.toString(16) }],
      });
    } catch (err) {
      alert("Please change to polygon network");
      return;
    }
  }

  return new ethers.providers.Web3Provider(provider);
}

$(document).ready(function () {
  $("#login").on("click", async function (event) {
    const provider = await getProvider();

    if (provider === undefined) return;

    // get message to sign
    let response = await fetch("/login/signature");
    let message = await response.text();

    console.log(message);

    const signer = provider.getSigner();

    const address = await signer.getAddress();
    const signature = await signer.signMessage(message);

    response = await fetch("/login/check_signature", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        address: address,
        signature: signature,
        _token: $('meta[name="csrf-token"]').attr("content"),
      }),
    });
    message = await response.text();

    if (message == "Success") {
      window.location.href = "/";
    } else {
      alert(message);
    }
  });

  $("#join_game").on("click", async function (event) {
    event.preventDefault();

    // check treasure token ownership
    let response = await fetch("/can_play_game");
    let message = await response.text();

    console.log(message);
    if (message !== "Yes") {
      alert("Can't join the game - you need a treasure NFT to join a game!");
      return;
    }

    const provider = await getProvider();

    if (provider === undefined) return;

    const addrUSDT = $("#usdt_addr").val();
    const recipient = $("#deposit_addr").val();
    const amount = $("#points").val();

    console.log(addrUSDT, recipient, amount);

    setTxStatus("Waiting user approval...");

    const signer = provider.getSigner();

    const address = await signer.getAddress();

    console.log(address);

    // The ERC-20 Contract ABI, which is a common contract interface
    // for tokens (this is the Human-Readable ABI format)
    const usdtAbi = [
      // Read-Only Functions
      "function balanceOf(address owner) view returns (uint256)",
      "function decimals() view returns (uint8)",
      "function symbol() view returns (string)",

      // Authenticated Functions
      "function transfer(address to, uint amount) returns (bool)",

      // Events
      "event Transfer(address indexed from, address indexed to, uint amount)",
    ];

    // The Contract object
    const usdt = new ethers.Contract(addrUSDT, usdtAbi, signer);
    const decimals = await usdt.decimals();

    console.log(await usdt.balanceOf(address));

    usdt
      .transfer(recipient, ethers.utils.parseUnits(amount, decimals))
      .then((tx) => {
        setTxStatus("Waiting transaction is confirmed...");
        tx.wait()
          .then((res) => {
            console.log(tx.hash);
            $("#tx_hash").val(tx.hash);
            $("#form_join").trigger("submit");
          })
          .catch((err) => setTxStatus(err.message));
      })
      .catch((err) => {
        setTxStatus(err.message);
      });
  });
});

function confirmationModal() {
  $("#confirmation-modal").modal();
}

function termsModal() {
  $("#terms-modal").modal();
}

function setTxStatus(status) {
  console.log(status);
  $("#tx_status").html(status);
  confirmationModal();
}

async function createNewGame(form) {
  // termsModal();
  // check Pirate token ownership
  let response = await fetch("/can_create_game");
  let message = await response.text();

  console.log(message);
  if (message !== "Yes") {
    alert("Can't create game - you need a pirate NFT to create a game!");
    return;
  }

  const provider = await getProvider();

  if (provider === undefined) return;

  const addrUSDT = $("#usdt_addr").val();
  const recipient = $("#deposit_addr").val();
  const amount = $("#points").val();

  console.log(addrUSDT, recipient, amount);

  setTxStatus("Waiting user approval...");

  const signer = provider.getSigner();

  const address = await signer.getAddress();

  console.log(address);

  // The ERC-20 Contract ABI, which is a common contract interface
  // for tokens (this is the Human-Readable ABI format)
  const usdtAbi = [
    // Read-Only Functions
    "function balanceOf(address owner) view returns (uint256)",
    "function decimals() view returns (uint8)",
    "function symbol() view returns (string)",

    // Authenticated Functions
    "function transfer(address to, uint amount) returns (bool)",

    // Events
    "event Transfer(address indexed from, address indexed to, uint amount)",
  ];

  // The Contract object
  const usdt = new ethers.Contract(addrUSDT, usdtAbi, signer);
  const decimals = await usdt.decimals();

  console.log(await usdt.balanceOf(address));

  usdt
    .transfer(recipient, ethers.utils.parseUnits(amount, decimals))
    .then((tx) => {
      setTxStatus("Waiting transaction is confirmed...");
      tx.wait()
        .then((res) => {
          console.log(tx.hash);
          $("#tx_hash").val(tx.hash);
          form.submit();
        })
        .catch((err) => setTxStatus(err.message));
    })
    .catch((err) => {
      setTxStatus(err.message);
    });
}

function setDelegationCreateParam(tokenId) {
  $("#token_id").val(tokenId);
  $("#duration-time-modal").modal();
}

async function createDelegationOffer() {
  if ($("#param_duration").val() <= 0) {
    alert("Duration is invalid");
    return;
  }
  $("#duration-time-modal").modal("hide");

  tokenId = $("#token_id").val();
  const duration = $("#param_duration").val();

  // check Pirate token ownership
  const provider = await getProvider();

  if (provider === undefined) return;

  setTxStatus("Waiting user approval...");

  const signer = provider.getSigner();

  const addrNft = $("#nft_addr").val();

  // The ERC-20 Contract ABI, which is a common contract interface
  // for tokens (this is the Human-Readable ABI format)
  const nftAbi = [
    "function offerRent(uint256 tokenId, uint256 duration) external",
  ];

  // The Contract object
  const nft = new ethers.Contract(addrNft, nftAbi, signer);

  nft
    .offerRent(tokenId, duration)
    .then((tx) => {
      setTxStatus("Waiting transaction is confirmed...");
      tx.wait()
        .then((res) => {
          console.log(tx.hash);
          $("#tx_hash").val(tx.hash);
          $("#token_id").val(tokenId);
          $("#duration").val(duration);
          $("#type").val("create");
          document.getElementById("form_delegation").submit();
        })
        .catch((err) => setTxStatus(err.message));
    })
    .catch((err) => {
      setTxStatus(err.message);
    });
}

async function cancelDelegationOffer(tokenId) {
  // check Pirate token ownership
  const provider = await getProvider();

  if (provider === undefined) return;

  setTxStatus("Waiting user approval...");

  const signer = provider.getSigner();

  const addrNft = $("#nft_addr").val();

  // The ERC-20 Contract ABI, which is a common contract interface
  // for tokens (this is the Human-Readable ABI format)
  const nftAbi = ["function cancelOffer(uint256 tokenId) external"];

  // The Contract object
  const nft = new ethers.Contract(addrNft, nftAbi, signer);

  nft
    .cancelOffer(tokenId)
    .then((tx) => {
      setTxStatus("Waiting transaction is confirmed...");
      tx.wait()
        .then((res) => {
          console.log(tx.hash);
          $("#tx_hash").val(tx.hash);
          $("#token_id").val(tokenId);
          $("#type").val("cancel");
          $("#duration").val("0");
          document.getElementById("form_delegation").submit();
        })
        .catch((err) => setTxStatus(err.message));
    })
    .catch((err) => {
      setTxStatus(err.message);
    });
}

async function removeBorrowing(tokenId) {
  // check Pirate token ownership
  const provider = await getProvider();

  if (provider === undefined) return;

  setTxStatus("Waiting user approval...");

  const signer = provider.getSigner();

  const addrNft = $("#nft_addr").val();

  // The ERC-20 Contract ABI, which is a common contract interface
  // for tokens (this is the Human-Readable ABI format)
  const nftAbi = ["function endRent(uint256 tokenId) external"];

  // The Contract object
  const nft = new ethers.Contract(addrNft, nftAbi, signer);

  nft
    .endRent(tokenId)
    .then((tx) => {
      setTxStatus("Waiting transaction is confirmed...");
      tx.wait()
        .then((res) => {
          console.log(tx.hash);
          $("#tx_hash").val(tx.hash);
          $("#token_id").val(tokenId);
          $("#type").val("remove");
          $("#duration").val("0");
          document.getElementById("form_delegation").submit();
        })
        .catch((err) => setTxStatus(err.message));
    })
    .catch((err) => {
      setTxStatus(err.message);
    });
}

async function borrow(tokenId, duration) {
  confirmationModal();
  // check Pirate token ownership
  const provider = await getProvider();

  if (provider === undefined) return;

  setTxStatus("Waiting user approval...");

  const signer = provider.getSigner();

  const addrNft = $("#nft_addr").val();
  const addrUSDT = $("#usdt_addr").val();

  console.log(addrUSDT);

  // The ERC-20 Contract ABI, which is a common contract interface
  // for tokens (this is the Human-Readable ABI format)
  const nftAbi = [
    "function fulfillOffer(uint256 tokenId) external",
    "function ownerOf(uint256 _tokenId) external view returns (address)",
  ];
  const usdtAbi = [
    "function approve(address _spender, uint256 _value) public returns (bool success)",
    "function decimals() view returns (uint8)",
  ];

  // The Contract object
  const nft = new ethers.Contract(addrNft, nftAbi, signer);
  const usdt = new ethers.Contract(addrUSDT, usdtAbi, signer);

  const owner = await nft.ownerOf(tokenId);
  const decimals = await usdt.decimals();
  const unit = ethers.BigNumber.from(10).pow(decimals - 1);
  console.log(unit);
  const cost = ethers.BigNumber.from(duration * 5).mul(unit);

  console.log(owner, decimals, cost);

  // approve USDT to payment for borrowing
  usdt
    .approve(addrNft, cost)
    .then((tx) => {
      setTxStatus("Waiting token approval is confirmed...");
      tx.wait()
        .then((res) => {
          setTxStatus("Borrowing...");
          // fulfilling offer
          nft
            .fulfillOffer(tokenId)
            .then((tx) => {
              setTxStatus("Waiting borrow transaction is confirmed...");
              tx.wait()
                .then((res) => {
                  console.log(tx.hash);
                  $("#tx_hash").val(tx.hash);
                  fetch("/borrow/" + tx.hash + "/" + tokenId)
                    .then((res) =>
                      res
                        .text()
                        .then((msg) => alert(msg))
                        .catch((err) => setTxStatus(err.message))
                    )
                    .catch((err) => setTxStatus(err.message));
                })
                .catch((err) => setTxStatus(err.message));
            })
            .catch((err) => setTxStatus(err.message));
        })
        .catch((err) => setTxStatus(err));
    })
    .catch((err) => setTxStatus(err));
}

async function buyNft(tokenId) {
  const provider = await getProvider();

  if (provider === undefined) return;

  confirmationModal();
  setTxStatus("Waiting user approval...");

  const signer = provider.getSigner();

  const addrVendor = $("#vendor_addr").val();
  const addrUSDT = $("#usdt_addr").val();
  const vendorAbi = [
    "function buyNft(uint256 tokenId, bool withReferrer) external",
  ];
  const usdtAbi = [
    "function approve(address _spender, uint256 _value) public returns (bool success)",
    "function decimals() view returns (uint8)",
  ];

  // The Contract object
  const vendor = new ethers.Contract(addrVendor, vendorAbi, signer);
  const usdt = new ethers.Contract(addrUSDT, usdtAbi, signer);
  const price = tokenId <= 125 ? 5 : 1;

  const decimals = await usdt.decimals();
  const unit = ethers.BigNumber.from(10).pow(decimals);
  console.log(unit);
  const cost = ethers.BigNumber.from(price).mul(unit);

  console.log(addrVendor, decimals, cost);

  // approve USDT to payment for borrowing
  usdt
    .approve(addrVendor, cost)
    .then((tx) => {
      setTxStatus("Waiting token approval is confirmed...");
      tx.wait()
        .then((res) => {
          setTxStatus("Buying...");
          // fulfilling offer
          vendor
            .buyNft(tokenId, false)
            .then((tx) => {
              setTxStatus("Waiting buying transaction is confirmed...");
              tx.wait()
                .then((res) => {
                  console.log(tx.hash);
                  $("#tx_hash").val(tx.hash);
                  // fetch("/borrow/" + tx.hash + "/" + tokenId)
                  //   .then((res) =>
                  //     res
                  //       .text()
                  //       .then((msg) => alert(msg))
                  //       .catch((err) => setTxStatus(err.message))
                  //   )
                  //   .catch((err) => setTxStatus(err.message));
                })
                .catch((err) => setTxStatus(err.message));
            })
            .catch((err) => setTxStatus(err.message));
        })
        .catch((err) => setTxStatus(err));
    })
    .catch((err) => setTxStatus(err));
}
