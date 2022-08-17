$(document).ready(function () {
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

    if (provider == undefined) {
      alert("Coinbase wallet is not installed");
      return;
    }

    // connect to wallet
    try {
      await provider.request({ method: "eth_requestAccounts", params: [] });
    } catch (err) {
      alert("Wallet connection is denied by user");
      return;
    }

    // change to polygon network
    const targetChain = 80001; // mumbai testnet
    // const targetChain = 137; // polygon

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

  $("#create_game").on("click", async function (event) {
    event.preventDefault();

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
            $("#form").trigger("submit");
          })
          .catch((err) => setTxStatus(err.message));
      })
      .catch((err) => {
        setTxStatus(err.message);
      });
  });

  function setTxStatus(status) {
    $("#tx_status").html(status);
  }
});
