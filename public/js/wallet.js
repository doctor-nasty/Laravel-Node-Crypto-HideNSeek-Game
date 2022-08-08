$(document).ready(function() {
  function getCoinbaseWalletProvider() {
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

    return provider;
  }

  $("#login").on("click", async function(event) {
    let targetChain = 4; // polygon
    let provider = getCoinbaseWalletProvider();

    if (provider === undefined) {
      alert("Coinbase wallet is not installed");
      return;
    }

    // change to polygon network
    if (provider.getChainId() != targetChain) {
      try {
        await provider.request({
          method: "wallet_switchEthereumChain",
          params: [{ chainId: targetChain.toString(16) }],
        });
      } catch (err) {
        console.log(err);
        return;
      }
    }

    // get message to sign
    let response = await fetch("/login/signature");
    let message = await response.text();

    console.log(message);

    console.log(provider);

    await provider.send("eth_requestAccounts", []);
    const address = provider._addresses[0];
    console.log(address);

    const signature = await provider.request({
      method: "eth_sign",
      params: [address, message],
    });
    console.log(signature);

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
    }
  });
});
